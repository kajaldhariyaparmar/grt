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

class CfpaypalController extends Controller
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
            
            return redirect('/payment-complete');
        }
    }
}
