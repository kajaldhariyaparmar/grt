<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use DateTime;
use Input;
Use Auth;
use Storage;
use Mail;
Use App\Models\Cfdonor;
Use App\Models\Cfdonation;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Redirect;
Use Response;

class CfpaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Fetch the Stripe Single payment token 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cfPaymentProcess(Request $request)
    {
        $data = $request->form;
        
        // Amount in cents
        $amount = $data['amount'];
        $amount = $this->convertAmountCents($amount);
        
        // Request single payment to the Stripe
        $token = $request->id;
        $s = new Stripe_sca();
        $s->url .= 'charges';
        $s->fields['amount'] = $amount;
        $s->fields['currency'] = 'gbp'; 
        $s->fields['source'] = $token; 
        $paymentdata = $s->call();

        // // Insert into the database
        // $result = $this->donationsInsertDatabase($request->form);

        return response()->json($paymentdata);
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
     * Insert data after successful payment
     * @param formdata
     * @return \Illuminate\Http\Response
     */
    public function cfPaymentDataProcess( Request $request)
    {
        $donationData = $request->form;

        $reference = substr(md5(mt_rand()), 0, 8);
        $now = new DateTime();

        $donationData['reference'] = $reference;
        $donationData['created_at'] = $now;
        $donationData['updated_at'] = $now;

        // Giftaid
        if(isset($donationData['giftaid'])) {
           $donationData['giftaid'] = "Yes"; 
        } else {
            $donationData['giftaid'] = "No";
        }
        // Hide name
        if(isset($donationData['hide_name'])) {
           $donationData['hide_name'] = "Yes"; 
        } else {
            $donationData['hide_name'] = "No";
        }

        try {
            // Insert donor data
            $cfdonor = new Cfdonor;
            $cfdonor->firstname = $donationData['firstname'];
            $cfdonor->lastname = $donationData['lastname'];
            $cfdonor->email = $donationData['email'];
            if(isset($donationData['phone']))
            $cfdonor->phone = $donationData['phone'];
            $cfdonor->campaign = $donationData['campaign'];
            $cfdonor->reference = $reference;
            $cfdonor->address = $donationData['address'];
            $cfdonor->city = $donationData['city'];
            $cfdonor->postcode = $donationData['postcode'];         
            $cfdonor->save();

            // Save & unset author details & campaign slug
            $slug = $donationData['slug'];
            $author_id = $donationData['member_id'];
            $author = $donationData['author'];
            unset($donationData['author']);
            unset($donationData['member_id']);
            unset($donationData['slug']);

            // Insert donation data
            Cfdonation::insert($donationData);

        } catch (\Exception $exception) {
            return response()->json([
                // 'result' => $exception->getMessage(),
                'result' => "Payment processed successfully but something went wrong with data inserting. Thank you for the payment.",
            ], 200);
        }

        // Set author again
        $donationData['author'] = $author;
        $donationData['slug'] = $slug;

        $sender_name = $donationData['firstname'];
        $sender_email = $donationData['email'];

        $campaigner = User::find($author_id);

        try {
            // sending email to admin 
            Mail::send('emails/cf.cf-campaigner-receive-donation', array('donation_data' => $donationData ), function ($message) use ($sender_name, $sender_email, $campaigner) {
                $message->from($sender_email, $sender_name);
                $message->subject('Got a new donation');
                $message->to($campaigner->email);
            }); 

            // sending email to donor 
            Mail::send('emails/cf.cf-donor-thankyou', array('donation_data' => $donationData ), function ($message) use ($sender_name, $sender_email) {
                $message->from('info@charityplatform.com', 'Charity platform fundraising');
                $message->subject('Thank you for your donation');
                $message->to($sender_email);
            });
        } catch (\Exception $exception) {
            return response()->json([
                // 'result' => $exception->getMessage(),
                'result' => "Payment processed successfully but something went wrong with sending you the confirmation email. Thank you for the payment."
            ], 200);
        }

        return response()->json(['result' => 'success']);

    }

    /**
     * Add offline donation
     * @return \Illuminate\Http\Response
     */
    public function add_offline_donation(Request $request)
    {
        if($request->ajax()) {
            $donation_data = $request->all();
            $validator = Validator::make($request->all(), [
            'amount' => 'required|max:255',
            ]);
            
            if ($validator->passes()) {
                $reference = substr(md5(mt_rand()), 0, 8);
                $now = new DateTime();

                $donation_data['reference'] = $reference;
                $donation_data['created_at'] =$now;
                $donation_data['updated_at'] = $now;
                
                // save to database
                Cfdonation::insert($donation_data);
                
                return response()->json(['success'=>'Success']);
            }
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }


    
    /**
     * Export cf donations to csv file
     *
     * @return \Illuminate\Http\Response
     */
    public function cfdonationsexport(Request $request)
    {    
        $data = $request->all();
        $ids = explode(",", $data['ids']);
        // print_r($data['ids']); die();

        if(strlen($data['ids']) > 0) { // export selected items
            $donations = Cfdonation::whereIn('cfdonations.id', $ids)
            ->get();
            $donations = json_decode(json_encode($donations), true);

            $headers = [
                    'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
                ,   'Content-type'        => 'text/csv'
                ,   'Content-Disposition' => 'attachment; filename=cfdonations.csv'
                ,   'Expires'             => '0'
                ,   'Pragma'              => 'public'
            ];        

            # add headers for each column in the CSV download
            array_unshift($donations, array_keys($donations[0]));

            $callback = function() use ($donations) 
            {
                $FH = fopen('php://output', 'w');
                foreach ($donations as $donation) { 
                    fputcsv($FH, $donation);
                }
                fclose($FH);
            };

            return Response::stream($callback, 200, $headers);

         }  else { // export all
            $donations = Cfdonation::all();
            $donations = json_decode(json_encode($donations), true);

            $headers = [
                    'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
                ,   'Content-type'        => 'text/csv'
                ,   'Content-Disposition' => 'attachment; filename=cfdonations.csv'
                ,   'Expires'             => '0'
                ,   'Pragma'              => 'public'
            ];        

            # add headers for each column in the CSV download
            array_unshift($donations, array_keys($donations[0]));

            $callback = function() use ($donations) 
            {
                $FH = fopen('php://output', 'w');
                foreach ($donations as $donation) { 
                    fputcsv($FH, $donation);
                }
                fclose($FH);
            };

            return Response::stream($callback, 200, $headers);
        //     return redirect()->back();
        //     // return response('Hello World', 200)
        //     //       ->header('Content-Type', 'text/plain');
         }      
    }

    /**
     * Export cf donors to csv file
     *
     * @return \Illuminate\Http\Response
     */
    public function cfdonorsexport(Request $request)
    {    
        $data = $request->all();
        $ids = explode(",", $data['ids']);

        if(strlen($data['ids']) > 0) { // export selected items
            $donations = Cfdonor::whereIn('cfdonors.id', $ids)
            ->get();
            $donations = json_decode(json_encode($donations), true);

            $headers = [
                    'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
                ,   'Content-type'        => 'text/csv'
                ,   'Content-Disposition' => 'attachment; filename=cfdonors.csv'
                ,   'Expires'             => '0'
                ,   'Pragma'              => 'public'
            ];        

            # add headers for each column in the CSV download
            array_unshift($donations, array_keys($donations[0]));

            $callback = function() use ($donations) 
            {
                $FH = fopen('php://output', 'w');
                foreach ($donations as $donation) { 
                    fputcsv($FH, $donation);
                }
                fclose($FH);
            };

            return Response::stream($callback, 200, $headers);
        } else {
            $donations = Cfdonor::all();
            $donations = json_decode(json_encode($donations), true);

            $headers = [
                    'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
                ,   'Content-type'        => 'text/csv'
                ,   'Content-Disposition' => 'attachment; filename=cfdonors.csv'
                ,   'Expires'             => '0'
                ,   'Pragma'              => 'public'
            ];        

            # add headers for each column in the CSV download
            array_unshift($donations, array_keys($donations[0]));

            $callback = function() use ($donations) 
            {
                $FH = fopen('php://output', 'w');
                foreach ($donations as $donation) { 
                    fputcsv($FH, $donation);
                }
                fclose($FH);
            };

            return Response::stream($callback, 200, $headers);
        }

    }

} 

/**********Stripe class starts*************************/
class Stripe_sca {
    public $headers;
    public $url = 'https://api.stripe.com/v1/';
    public $fields = array();
    public $secret_key;
    // public $secret_key = "sk_test_FXo0UsjEA1OUpYsFABwWZAPQ"; // Mamunur secret_key
    
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
/**********Stripe class ends*************************/