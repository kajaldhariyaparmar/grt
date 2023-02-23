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

class PaypalController extends Controller
{
    /**
     * Paypal payment result
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paypal_payment()
    {
        if(isset($_GET['tx']) && !empty($_GET['tx'])) {
            echo $_GET['tx'];
            // // Form data
            // $order = Session::get('order');
            // // Guest user: register as a new user
            // if (!Auth::check()) {
            //     $user = User::create([
            //         'name' => $order['name']." ".$order['lastname'],
            //         'email' => $order['email'],
            //         'password' => Hash::make($order['password']),
            //     ]);
        
            //     event(new Registered($user));
        
            //     Auth::login($user);
            // }

            // // Generate random number
            // $reference = substr(md5(mt_rand()), 0, 8);
            
            // // Create new customer
            // $last_customer_id = $this->create_customer($order, $reference);

            // // Create new order
            // $this->create_order($order, $reference, $last_customer_id);

            // // Send email 
            // $this->send_email($order, $reference);
            
            // // Cart destroy
            // Cart::destroy();
            return redirect('/payment-complete');
        }
    }
}
