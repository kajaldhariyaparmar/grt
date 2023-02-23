<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
Use App\Donation;
Use App\Models\Donor;
use Mail;
use DateTime;

use function GuzzleHttp\json_decode;

class PaymentController extends Controller
{
    /**
     * Fetch the Stripe Single payment token 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function singlePaymentProcess(Request $request)
    {
        $amount_single = 0;
        $amount_monthly = 0;
        $amount_weekly = 0;
        foreach($request->cartContent as $row) :
            if($row['paymenttype'] == "Monthly") {
                $amount_monthly += $row['totalPrice'];
            } else if($row['paymenttype'] == "Weekly") {
                $amount_weekly += $row['totalPrice'];
            } else { 
                $amount_single += $row['totalPrice'];
            }       
        endforeach;

        $adminCost = $amount_single + $amount_monthly + $amount_weekly;
        $adminCost = $request->cartTotal - $adminCost;

        // cart total in cents
        $cartTotal = $amount_single + $adminCost;
        $cartTotal = $this->convertAmountCents($cartTotal);
        
        // request single payment to Stripe
        $token = $request->id;
        $s = new Stripe_sca();
        $s->url .= 'charges';
        $s->fields['amount'] = $cartTotal;
        $s->fields['currency'] = 'gbp'; 
        $s->fields['source'] = $token; 
        $paymentdata = $s->call();

        // $paymentinfo = $paymentdata['payment_method'];

        // CRM webhook
        $result = $this->crmwebhook_single($request->reference, $request->user, $request->cartContent, $request->currency, $paymentdata);
        
        $this->donationsInsertDatabase($request->reference, $request->user, $request->cartContent, $request->cartTotal, $request->currency);

        return response()->json($paymentdata);
    }

     /**
     * Monthly payment process
     * @return \Illuminate\Http\Response
     */
    public function monthlyPaymentProcess(Request $request)
    {
        $data = $request->all();
        
        // Gocardless things
        $gocardless_result_json = $this->gocardlessPaymentProcess($data);
        
        // JSON to array
        $gocardless_result = json_decode($gocardless_result_json);
        
        if(isset($gocardless_result->error)) 
            return $gocardless_result_json;
        if(isset($gocardless_result->mandate)) {
            $mandateid = $gocardless_result->mandate;
            
            // CRM webhook
            $result = $this->crmwebhook_monthly($mandateid, $request->reference, $request->user, $request->cartContent, $request->currency);
            
            $amount_single = 0;
            $amount_monthly = 0;
            $amount_weekly = 0;
            foreach($request->cartContent as $row) :
                if($row['paymenttype'] == "Monthly") {
                    $amount_monthly += $row['totalPrice'];
                } else if($row['paymenttype'] == "Weekly") {
                    $amount_weekly += $row['totalPrice'];
                } else { 
                    $amount_single += $row['totalPrice'];
                }       
            endforeach;

            // Insert in the database
            if($amount_single == 0 && $amount_weekly == 0) // execute when no weekly/single payment exists in the cart
            $this->donationsInsertDatabase($request->reference, $request->user, $request->cartContent, $request->cartTotal, $request->currency);
    
            return response()->json(array('status' => 'active'));
        }
    }

    /**
     * Smartdebit recurring/weekly payment
     * @return \Illuminate\Http\Response
     */
    public function weeklyPaymentProcess(Request $request)
    {  
        $amount_single = 0;
        $amount_monthly = 0;
        $amount_weekly = 0;
        foreach($request->cartContent as $row) :
            if($row['paymenttype'] == "Monthly") {
                $amount_monthly += $row['totalPrice'];
            } else if($row['paymenttype'] == "Weekly") {
                $amount_weekly += $row['totalPrice'];
            } else { 
                $amount_single += $row['totalPrice'];
            }       
        endforeach;
        
        // insert in the database
        if($amount_monthly == 0) // execute when no monthly payment exists in the cart
        $this->donationsInsertDatabase( $request->reference, $request->user, $request->cartContent, $request->cartTotal, $request->currency);

        return response()->json(array('status' => 'active'));
    }

    /**
     * Gocardless: create customer
     * @return \Illuminate\Http\Response
     */
    public function gocardlessCustomer($data)
    {
        $gocardlesswebhook = new Gocardless_webhook();

        $gocardlesswebhook->url .= 'customers';
        
        // Create customer
        $gocardlesswebhook->data['customers'] = array(
            "email" => $data['user']['email'],
            "given_name" => $data['user']['name'],
            "family_name" => $data['user']['lastname'],
            "address_line1" => $data['user']['addressline1'],
            "address_line2" => $data['user']['addressline2'],
            "city" => $data['user']['city'],
            "postal_code" => $data['user']['postcode'],
            "country_code" => $data['user']['countryCode'],
            // "metadata" => array (
            //     "salesforce_id" => "ABCD1234"
            // )
        );

        $result = $gocardlesswebhook->call();

        return $result;
    }

    /**
     * Gocardless: create bank account
     * @return \Illuminate\Http\Response
     */
    public function gocardlessBankaccount($customerid, $data)
    {
        $gocardlesswebhook = new Gocardless_webhook();
        
        $gocardlesswebhook->url .= 'customer_bank_accounts';
        
        // Add Bank accounts
        $gocardlesswebhook->data['customer_bank_accounts'] = array(
            "account_number"=> $data['user']['accountnumber'],
            "branch_code" => $data['user']['sortcode'],
            "account_holder_name" => $data['user']['accountname'],
            "country_code" => "GB",
            "links" => array (
              "customer" => $customerid
            )
        );

        // $gocardlesswebhook->data['customer_bank_accounts'] = array(
        //     "account_number"=> "55779911",
        //     "branch_code" => "200000",
        //     "account_holder_name" => "Frank Osborne",
        //     "country_code" => "GB",
        //     "links" => array (
        //       "customer" => "CU000NSH6553VA"
        //     )
        // );

        $result = $gocardlesswebhook->call();

        return $result;

    }

    /**
     * Gocardless: create mandate
     * @return \Illuminate\Http\Response
     */
    public function gocardlessCreateMandate($accountnumber, $data)
    {
        $gocardlesswebhook = new Gocardless_webhook();
        
        // If bank account success then create mandates
        $gocardlesswebhook->url .= 'mandates';
        
        // Create mandates
        $gocardlesswebhook->data['mandates'] = array(
            "scheme" => "bacs",
            "metadata" => array (
                "contract" => $data['user']['contact'],
            ),
            "links" => array (
                "customer_bank_account" => $accountnumber,
                // "creditor" => "CR123",
                // "customer" => "CU000NSH6553VA"
            )
        );

        $result = $gocardlesswebhook->call();

        return $result;
    }

    /**
     * Gocardless recurring/monthly payment
     * @return \Illuminate\Http\Response
     */
    public function gocardlessPaymentProcess($data)
    {
        $gocardlesswebhook = new Gocardless_webhook();

        // Create customer
        $customer_result_josn = $this->gocardlessCustomer($data);

        // JSON to array
        $customer_result = json_decode($customer_result_josn);
        
        if(isset($customer_result->error)) 
            return $customer_result_josn;
        if(isset($customer_result->customers)) 
            $customerid = $customer_result->customers->id;
        
            // If customer success then create bank account
            $bankaccount_result_json = $this->gocardlessBankaccount($customerid, $data);
            
            // JSON to array
            $bankaccount_result = json_decode($bankaccount_result_json);
            
            if(isset($bankaccount_result->error)) 
                return $bankaccount_result_json;
            if(isset($bankaccount_result->customer_bank_accounts))
                $accountnumber = $bankaccount_result->customer_bank_accounts->id;
            
                $mandates_result_json = $this->gocardlessCreateMandate($accountnumber, $data);
                    
                // JSON to array
                $mandates_result = json_decode($mandates_result_json);

                if(isset($mandates_result->error)) 
                    return $mandates_result_json;
                if(isset($mandates_result->mandates))
                    $mandateid = $mandates_result->mandates->id;

                    return json_encode(array('mandate' => $mandateid));
    }

    /**
     * Amount converts into sents
     * 
     * @param amount
     * @return cents
     */
    public function convertAmountCents($amount) 
    {
        $amount = str_replace(",","", $amount);
        $amount = number_format((float)$amount, 2, '.', '');   
        $amount = $amount*100;
        return $amount;
    }

    /**
     * CRM - webhook for single donation
     * 
     * @param 
     * @return 
     */
    public function crmwebhook_single($reference, $userData, $cartContent, $currency, $paymentdata) {
        // Call webhook
        $crmwebhook = new GRT_crm_webhook();
        
        // Contact preferences
        $contactpreferences = array();
        foreach($userData['additionalSelected'] as $row) {
            $contactpreference = explode (":", $row); 
            $contactpreferences[$contactpreference[0]] = 
            array("administration" => "false","fundraising" => $contactpreference[1]);
        }
        // Allocations, total & individual prices, concate countries
        $amount_single = 0;
        $items = array();
        foreach($cartContent as $row) {
            if($row['paymenttype'] == "One-off") {
                $amount_single += $row['totalPrice'];
                if(isset($row['countries'])) {
                    $countries = trim(preg_replace("![^a-z0-9]+!i", "-", $row['countries']), '-');
                    $funddimensions = array("location" => $countries, "theme" => $row['theme'], "stipulation" => $row['appeal'] );
                    $items[] = array('amount' => $row['totalPrice'],'item' => $row['title'], 'type' => $row['allocation_type'], "FundDimensions" => $funddimensions);
                } else { // for quick donate
                    $funddimensions = array("location" => 'Most needed', "theme" => 'Most needed', "stipulation" => $row['appeal'] );
                    $items[] = array('amount' => $row['totalPrice'],'item' => $row['title'], "FundDimensions" => $funddimensions);
                }
            } 
        }

        // CRM data that need to be sent through API
        $crmwebhook->data['id'] = $reference;
        $crmwebhook->data['type'] = 'single donation';
        $crmwebhook->data['timestamp'] = time();
        $crmwebhook->data['ip'] = $_SERVER['REMOTE_ADDR'];
        $crmwebhook->data['reference'] = $reference;
        $crmwebhook->data['currency'] = $currency;
        $crmwebhook->data['amount'] = $amount_single;
        $crmwebhook->data['isOrganization'] = 'false';
        $crmwebhook->data['individual'] = array('title' => $userData['customertitle'],'first' => $userData['name'],'last' => $userData['lastname'] );
        // Ignore
        // $crmwebhook->data['organization'] = array('name' => "",'type' => "",'contact' => array('title' => "",'first' => "",'last' => "" ));
        $crmwebhook->data['address'] = array('line1' =>  $userData['addressline1'],'line2' => $userData['addressline2'],'line3' => "","line4" => "","townCity" =>  $userData['city'], "countyState" => "", "postcode" =>  $userData['postcode'], "countryCode" => $userData['countryCode'] );
        $crmwebhook->data['email'] =  $userData['email'];
        $crmwebhook->data['phone'] =  $userData['phone'];
        $crmwebhook->data['giftAid'] =  $userData['giftaid'];
        $crmwebhook->data['contactPreferences'] = $contactpreferences;
        $crmwebhook->data['allocation'] = $items;
        $crmwebhook->data['payment'] = array(
            'paymentMethodName' => "Stripe",
            'amount' => $amount_single,
            'stripe' => array(
                // "CustomerId" => "",
                "ChargeId" =>  $paymentdata['id'],
                "PaymentMethodId" => $paymentdata['payment_method'],
                // "PaymentIntentId" => "",
                )
        );
        
        // echo $payload = json_encode( $crmwebhook->data ); 
        // die('testjosnformat');

        $result = $crmwebhook->call(); 
        // echo $result;
        // die("dieinsidehook");
        return $result;
    }

    /**
     * CRM - webhook for monthly donation
     * 
     * @param 
     * @return 
     */
    public function crmwebhook_monthly($mandateid, $reference, $userData, $cartContent, $currency) {
        // Call webhook
        $crmwebhook = new GRT_crm_webhook();
        
       // Contact preferences
       $contactpreferences = array();
       foreach($userData['additionalSelected'] as $row) {
           $contactpreference = explode (":", $row); 
           $contactpreferences[$contactpreference[0]] = 
           array("administration" => "false","fundraising" => $contactpreference[1]);
       }
        
        // Allocations, total & individual prices, concate countries
        $amount_monthly = 0;
        $items = array();
        foreach($cartContent as $row) {
            if($row['paymenttype'] == "Monthly") {
                $amount_monthly += $row['totalPrice'];
                if(isset($row['countries']) && !empty($row['countries']))
                    $countries = trim(preg_replace("![^a-z0-9]+!i", "-", $row['countries']), '-');
                else 
                    $countries = 'Most needed'; // For Qick donate: As quick donate has no countries data
                
                if(isset($row['theme']) && !empty($row['theme']))
                    $theme = $row['theme'];
                else
                    $theme = 'Most needed'; // For Qick donate: As quick donate has no theme data

                if(isset($row['allocation_type']) && !empty($row['allocation_type']))
                    $allocation_type = $row['allocation_type'];
                else
                    $allocation_type = 'Most needed'; // For Qick donate: As quick donate has no allocation type data

                $funddimensions = array("location" => $countries, "theme" => $theme, "stipulation" => $row['appeal'] );
                $items[] = array('amount' => $row['totalPrice'],'item' => $row['title'], 'type' => $allocation_type, 'fundDimensions' => $funddimensions);
                $sponsorships[] = array('scheme' => $theme, 'duration' => 12, 'fundDimensions' => $funddimensions);
            }
        }

        // CRM data that need to be sent through API
        $crmwebhook->data['id'] = $reference;
        $crmwebhook->data['type'] = 'regular donation';
        $crmwebhook->data['timestamp'] = time();
        $crmwebhook->data['ip'] = $_SERVER['REMOTE_ADDR'];
        $crmwebhook->data['reference'] = $reference;
        $crmwebhook->data['currency'] = $currency;
        $crmwebhook->data['amount'] = $amount_monthly;
        $crmwebhook->data['isOrganization'] = 'false';
        $crmwebhook->data['individual'] = array('title' => $userData['customertitle'],'first' => $userData['name'],'last' => $userData['lastname'] );
        // Ignore
        // $crmwebhook->data['organization'] = array('name' => "",'type' => "",'contact' => array('title' => "",'first' => "",'last' => "" ));
        $crmwebhook->data['address'] = array('line1' =>  $userData['addressline1'],'line2' => $userData['addressline2'],'line3' => "","line4" => "","townCity" =>  $userData['city'], "countyState" => "", "postcode" =>  $userData['postcode'], "countryCode" => $userData['countryCode'] );
        $crmwebhook->data['email'] =  $userData['email'];
        $crmwebhook->data['phone'] =  $userData['phone'];
        $crmwebhook->data['giftAid'] =  $userData['giftaid'];
        $crmwebhook->data['contactPreferences'] = $contactpreferences;
        $crmwebhook->data['allocation'] = $items;
        $crmwebhook->data['sponsorships'] = $sponsorships;
        $crmwebhook->data['regularGiving'] = array(
            "frequency" => "monthly",
            "collectionDay" => 1,
        );

        $crmwebhook->data['credential'] = array(
            "paymentMethodName" => "gocardless",
            "GoCardless" => array(
                "MandateId" => $mandateid,
                "CustomerId" => ""
            )
        );

        // echo $payload = json_encode( $crmwebhook->data ); 
        // die('testjosnformat');

        $result = $crmwebhook->call(); 
        // echo $result;
        // die("dieinsidehook");
        return $result;
    }

    /**
     * CRM - webhook
     * 
     * @param 
     * @return 
     */
    public function crmwebhook($reference, $userData, $cartContent, $currency) {
        // Call webhook
        $crmwebhook = new GRT_crm_webhook();
        
        // Contact preferences
        $contactpreferences = array();
        foreach($userData['additionalSelected'] as $row) {
            $contactpreferences[$row] = 
            array("administration" => "false","fundraising" => "true");
        }

        $amount = 0;
        $amount_monthly = 0;
        $amount_weekly = 0;
        $amount_single = 0;
        $items = array();

        // Allocations, total & individual prices, concate countries
        foreach($cartContent as $row) {
            $amount += $row['totalPrice'];
            if($row['paymenttype'] == "Monthly") {
                $amount_monthly += $row['totalPrice'];
            } else if($row['paymenttype'] == "Weekly") {
                $amount_weekly += $row['totalPrice'];
            } else { 
                $amount_single += $row['totalPrice'];
            } 
            $countries = trim(preg_replace("![^a-z0-9]+!i", "-", $row['countries']), '-');
            $items[] = array('amount' => $row['totalPrice'],'item' => $row['title']."-".$row['appeal']."-".$countries, 'type' => $row['allocation_type']);
        }

        // CRM data that need to be sent through API
        $crmwebhook->data['id'] = $reference;
        $crmwebhook->data['timestamp'] = time();
        $crmwebhook->data['type'] = 'single';
        $crmwebhook->data['ip'] = $_SERVER['REMOTE_ADDR'];
        $crmwebhook->data['reference'] = $reference;
        $crmwebhook->data['currency'] = $currency;
        $crmwebhook->data['amount'] = $amount;
        $crmwebhook->data['isOrganization'] = 'false';
        $crmwebhook->data['individual'] = array('title' => "",'first' => $userData['name'],'last' => $userData['lastname'] );
        // Ignore
        // $crmwebhook->data['organization'] = array('name' => "",'type' => "",'contact' => array('title' => "",'first' => "",'last' => "" ));
        $crmwebhook->data['address'] = array('line1' =>  $userData['addressline1'],'line2' => $userData['addressline2'],'line3' => "","line4" => "","townCity" =>  $userData['city'], "countyState" => "", "postcode" =>  $userData['postcode'], "countryCode" => $userData['country'] );
        $crmwebhook->data['email'] =  $userData['email'];
        $crmwebhook->data['phone'] =  $userData['contact'];
        $crmwebhook->data['giftAid'] =  $userData['giftaid'];
        $crmwebhook->data['contactPreferences'] = $contactpreferences;
        $crmwebhook->data['allocation'] = $items;
        $crmwebhook->data['singlePayment'] = array(
            'paymentMethodName' => "Stripe",
            'amount' => $amount_single,
            'stripe' => array(
                "CustomerId" => "",
                "PaymentMethodId" => "",
                "PaymentIntentId" => "",)
        );
        $crmwebhook->data['weeklyPayment'] = array(
            "Type" => "smartdebit",
            "Amount:" => $amount_weekly,
            "SmartDebit" => array(
                "AccountName" => $userData['accountname'],
                "SortCode" => $userData['sortcode'], 
                "AccountNumber" => $userData['accountnumber']
            )
        );
        $crmwebhook->data['monthlyPayment'] = array(
            "Type" => "smartdebit",
            "Amount:" => $amount_monthly,
            "SmartDebit" => array(
                "AccountName" => $userData['accountname'],
                "SortCode" => $userData['sortcode'], 
                "AccountNumber" => $userData['accountnumber']
            )
        );
        
        // echo $payload = json_encode( $crmwebhook->data ); 
        // die('testjosnformat');

        $result = $crmwebhook->call(); 
        return $result;
    }

    /**
     * Dontation insertion into the database 
     *
     * @param  \Illuminate\Http\Request  $request, cart  content
     */
    public function donationsInsertDatabase($reference, $userData, $cartContent, $cartTotal, $currency)
    {
        $now = new DateTime();
        $amount_single = 0;
        $amount_monthly = 0;
        $amount_weekly = 0;
        foreach($cartContent as $row) :
            if($row['paymenttype'] == "Monthly") {
                $amount_monthly += $row['totalPrice'];
            } else if($row['paymenttype'] == "Weekly") {
                $amount_weekly += $row['totalPrice'];
            } else { 
                $amount_single += $row['totalPrice'];
            }       
        endforeach;

        $adminCost = $amount_single + $amount_monthly + $amount_weekly;
        $adminCost = $cartTotal - $adminCost;
        
        // Create new customer delete it
        $last_donor_id = $this->create_donor($userData);

        
        $i = 0;
        foreach($cartContent as $row) {
            $donation_data[$i]['amount'] = $row['totalPrice'];
            $donation_data[$i]['qty'] = $row['quantity'];
            $donation_data[$i]['type'] = $row['paymenttype'];
            $donation_data[$i]['appeal'] = $row['appeal'];
            $donation_data[$i]['title'] = $row['title'];
            $donation_data[$i]['currency'] = $currency;
            $donation_data[$i]['title_name'] = $userData['title'];
            $donation_data[$i]['name'] = $userData['name'];
            $donation_data[$i]['lastname'] = $userData['lastname'];
            $donation_data[$i]['email'] = $userData['email'];
            $donation_data[$i]['contact'] = $userData['phone'];
            $donation_data[$i]['address'] = $userData['addressline1']." ".$userData['addressline2'];
            if(isset($userData['city'])){
            $donation_data[$i]['city'] = $userData['city'];
            }
            if(isset($userData['postcode'])){
            $donation_data[$i]['postcode'] = $userData['postcode'];
            }
            $donation_data[$i]['country'] = $userData['countryCode'];
            $donation_data[$i]['giftaid'] = $userData['giftaid'];
            $donation_data[$i]['admincost'] = $adminCost;
            $donation_data[$i]['reference'] = $reference;
            $donation_data[$i]['additional_note'] = $userData['additionalDonateNote'];
            $donation_data[$i]['additional_contact'] = json_encode($userData['additionalSelected']);
            $donation_data[$i]['donor_id'] = $last_donor_id;
            $donation_data[$i]['created_at'] = $now;
            $donation_data[$i]['updated_at'] = $now;
            $i++;
        }
        
        // insert into the database
        Donation::insert($donation_data);

        $sender_name = $userData['name'];
        $sender_email = $userData['email'];

        // // sending email to admin 
        // Mail::send('emails.admin', array('reference' => $reference, 'admincost' => $adminCost, 'order' => $userData , 'cart_data' => $cartContent), function ($message) use ($sender_name, $sender_email) {
        //     $message->from($sender_email, $sender_name);
        //     $message->subject('Got a new donation');
        //     $message->to('mamunur.play@gmail.com');
        // }); 

        // // sending email to donor 
        // Mail::send('emails.thankyou', array('admincost' => $adminCost, 'order' => $userData , 'cart_data' => $cartContent), function ($message) use ($sender_name, $sender_email) {
        //     $message->from('info@grtuk.org', 'Global Relief Trust');
        //     $message->subject('Thank you for your donation');
        //     $message->to($sender_email);
        // });

        // User registration
        if(isset($userData['signup'])  && $userData['signup'] == 1) {
            if(isset($userData['password']) && !empty($userData['password'])) {
                Auth::login($user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                ]));
    
                event(new Registered($user));
    
                // Sending email to the user 
                Mail::send('emails.thankyou-register-user', array('data' => $userData), function ($message) use ($sender_name, $sender_email) {
                    $message->from('info@grtuk.org', 'Global Relief Trust');
                    $message->subject('Thank you for registering');
                    $message->to($sender_email);
                });
            }
        }
    }

    /**
     * Create new customer
     *
     * @return \Illuminate\Http\Response
     */
    public function create_donor($userdata)
    {  
        $donor = Donor::updateOrCreate(
            ['email' => $userdata['email']],
            [
            'title' => $userdata['title'], 
            'name' => $userdata['name'], 
            'lastname' => $userdata['lastname'],
            'contact' => $userdata['contact']
            ]
        );
        
        return $LastInsertId = $donor->id;
    }

    /**
     * Get Stripe public key form admin-settings 
     *
     */
    public function getStripepublickey()
    {
        return setting('stripe-settings.public_key');
    }
}

// GRT crm webhook. Collecting information after successful payment through API.
class GRT_crm_webhook {
    public $data;
    public $headers;
    // public $url = 'https://theplayculture.com/grt/api/contact';
    public $url = 'https://beta.n3o.cloud/eu1/hooks/import/106/2be35e37-ec3a-468d-8459-ba3322416eb3';

    function __construct () {
        $this->headers = array('Content-Type:application/json');
    }

    function call () {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        # Setup request to send json via POST.
        $payload = json_encode($this->data);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        // curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $this->headers);
        # Return response instead of printing.
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        # Send request.
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}

// Gocardless webhook
class Gocardless_webhook {
    public $data;
    public $headers;
    public $url = 'https://api-sandbox.gocardless.com/';
    public $access_token = "sandbox_OnwzDd3ZiACh9b-D5A5EjpuV29uH-gC55Tvbthsn"; // Mamunur secret_key

    function __construct () {
        $this->headers = array(
            'Content-Type:application/json',
            'GoCardless-Version: 2015-07-06',  
            'Authorization: Bearer '.$this->access_token
        );
    }

    function call () {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        # Setup request to send json via POST.
        $payload = json_encode($this->data);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        // curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $this->headers);
        # Return response instead of printing.
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        # Send request.
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}

/**********Stripe class starts*************************/

class Stripe_sca {
    
    public $headers;
    public $url = 'https://api.stripe.com/v1/';
    public $fields = array();
    public $secret_key = "sk_test_FXo0UsjEA1OUpYsFABwWZAPQ"; // Mamunur secret_key
    //public $secret_key;

    function __construct () {
        $this->secret_key = setting('stripe-settings.secret_key');
        $this->headers = array('Authorization: Bearer '.$this->secret_key);
        // $this->headers = array('Authorization: Bearer sk_test_FXo0UsjEA1OUpYsFABwWZAPQ'); // STRIPE_API_KEY = your stripe api key
    }

    function call () {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->fields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output, true); // return php array with api response
    }
}
