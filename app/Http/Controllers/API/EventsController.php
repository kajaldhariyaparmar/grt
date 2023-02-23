<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Event;
use App\Models\Eventbooking;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Fetch upcoming events
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUpcomingEvents()
    {
        $upcomingevents = Event::where('status', 'published')->where('start_date', '>=', date('Y-m-d'))->orderBy('start_date', 'desc')->get();
        return response()->json($upcomingevents);
    }

    /**
     * Fetch past events
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPastEvents()
    {
        $pastevents = Event::where('status', 'published')->where('start_date', '<', date('Y-m-d'))->orderBy('start_date', 'desc')->get();
        return response()->json($pastevents);
    }

    /**
     * Event single page
     *
     * @return \Illuminate\Http\Response
     */
    public function single($slug)
    {
        // fetch the event
        $event = Event::where('slug', $slug)->first();
        return response()->json(array('event' => $event));
    }

    /**
     * Event booking form process
     *
     * @return \Illuminate\Http\Response
     */
    public function processevents(Request $request)
    {
        // $var = $request->all();
        // return $var;
        $data = $request->form;
        $data['notickets'] = json_encode( $data['notickets']);

        // echo "<pre>"; print_r($data);

        // die("die");

        // insert into the database
        try {
            // Insert into the database
            Eventbooking::create($data);

            // Email section
           // $sender_name = $data['name'];
            //$sender_email = $data['email'];

            // sending email to the admin
            // Mail::send('emails.admin-event', array('data' => $data), function ($message) use ($sender_name, $sender_email) {
            //     $message->from($sender_email, $sender_name);
            //     $message->subject('New event booking');
            //     $message->to('mamunur.play@gmail.com');
            // });

            // sending email to the user
            // Mail::send('emails.thankyou-event', array('data' => $data), function ($message) use ($sender_name, $sender_email) {
            //     $message->from('info@cp.com', 'GRT charity platform');
            //     $message->subject('Thank you for your booking.');
            //     $message->to($sender_email);
            // });
        } catch(Exception $e) {
            return $e->getMessage();
        }

        return "success";
    }

    /**
     * Fetch the Stripe Single payment token
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function eventPaymentProcess(Request $request)
    {
        $amount = 10;

        $amount = $this->convertAmountCents($amount);

        // request single payment to Stripe
        $token = $request->id;
        $s = new Stripe_sca();
        $s->url .= 'charges';
        $s->fields['amount'] = $amount;
        $s->fields['currency'] = 'gbp';
        $s->fields['source'] = $token;
        $paymentdata = $s->call();

        // CRM webhook
        // $result = $this->crmwebhook_single($request->reference, $request->user, $request->cartContent, $request->currency, $paymentdata);

        // $this->donationsInsertDatabase($request->reference, $request->user, $request->cartContent, $request->cartTotal, $request->currency);

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
}

/**********Stripe class starts*************************/

class Stripe_sca {
    public $headers;
    public $url = 'https://api.stripe.com/v1/';
    public $fields = array();
    // public $secret_key = "sk_test_FXo0UsjEA1OUpYsFABwWZAPQ"; // Mamunur secret_key
    public $secret_key;

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
