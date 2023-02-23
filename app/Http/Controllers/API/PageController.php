<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\About;
use App\Models\Homesetting;
// Use App\Models\User;
Use App\Models\Donation;
use Mail;
Use Response;
Use DB;
Use Hash;
use Illuminate\Foundation\Auth\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class PageController extends Controller
{
    // use Authenticatable;
    use AuthenticatesUsers;

    /**
     * Home settings
     *
     * @return \Illuminate\Http\Response
     */
    public function getHomesettingsdata()
    {
        $homesettings = Homesetting::all();
        return response()->json($homesettings);
    }

    /**
     * Header tags
     *
     * @return \Illuminate\Http\Response
     */
    public function getHeaderTags()
    {
        $headertags = setting('site.header_tag');
        return response()->json($headertags);
    }

    /**
     * About
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        $about = About::where('slug', 'about')->first();
        return response()->json($about);
    }

    /**
     * Contact
     *
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request)
    {
        // $var = $request->all();
        // return $var;
        $data = $request->form;

        // insert into the database
        try {
        Contact::insert($data);
        // Email section
        $sender_name = $data['name'];
        $sender_email = $data['email'];

        // sending email to the admin 
        Mail::send('emails.admin-contact', array('data' => $data), function ($message) use ($sender_name, $sender_email) {
            $message->from($sender_email, $sender_name);
            $message->subject('New contact enquiry');
            $message->to('mamunur.play@gmail.com');
        }); 

        // sending email to the user 
        Mail::send('emails.thankyou-contact', array('data' => $data), function ($message) use ($sender_name, $sender_email) {
            $message->from('info@cp.com', 'Charity platform');
            $message->subject('Thank you for your enquiry.');
            $message->to($sender_email);
        });
        } catch(Exception $e) {
        return $e->getMessage();
        }
        return "success";
    }

    /**
     * Get login state
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoginState()
    {
        if (Auth::check())
            return "true";
        else 
            return "false";
    }

    /**
     * Get loggedin user id
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoginUserId()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return $user->id;
        }
    }

    /**
     * Get loggedin user name
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoginUserName()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return $user->name;
        }
    }

    /**
     * Get loggedin user details
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoginUserdetails()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return $user->email;
        }
    }

    /**
     * Check unique email for checkout page registration
     *
     * @return flag
     */
    public function checkUniqueEmail($email)
    {
        $users = User::where('email', '=', $email)->first();
        return ($users === null)?0:1;
    }

    // test
    
    public function checkLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['success' => Auth::user(), 200]);
            // return response()->json(Auth::user(), 200);
        } 
        
        return response()->json(['error' => "Login details are not valid"]);
    }
    public function check_login1(Request $request)
    {
        // $request->authenticate();
        $email=$request->email;
        $password=$request->password;

        
        if(Auth::attempt(['email'=>$email,'password'=>$password]))
        {
            return "success";
        }
        return "Wrong Credentials";
        dd();
        $credentials = $request->json()->all();
        // $credentials = $request->only('username', 'password');

        // dd($credentials);
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        } else {
            return redirect('/login')->with('error', 'Invalid Email address or Password');
        }
    }

    /**
     * Export orders to csv file
     *
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {    
        $data = $request->all();
        $ids = explode(",", $data['ids']);
        //print_r($data); die();

        if(strlen($data['ids']) > 0) { // export selected items
            $donations = Donation::whereIn('donations.id', $ids)->get();
            //print_r('<pre>');
            //print_r($donations);die;
            //$donations = json_decode(json_encode($donations), true);

            $headers = [
                    'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
                ,   'Content-type'        => 'text/csv'
                ,   'Content-Disposition' => 'attachment; filename=donations.csv'
                ,   'Expires'             => '0'
                ,   'Pragma'              => 'public'
            ];        
            
            # add headers for each column in the CSV download
            //array_unshift($donations, array_keys($donations[0]));
            $columns = array('Donation Number','Donation Status','Donation Date','Title','First Name', 'Last Name'
                        ,'Company (Billing)','Address 1&2 (Billing)','City (Billing)'
                        ,'State Code (Billing)','Postcode (Billing)','Country Code (Billing)','Email (Billing)'
                        ,'Phone (Billing)','Customer Note','Keep in Touch','Reclaim Gift Aid','Payment Method'
                        ,'Donation Name','Donation Type','Donation Quantity','Donation Line Total'
                        ,'Donation Total Amount');
            /*$callback = function() use ($donations) 
            {
                $FH = fopen('php://output', 'w');
                foreach ($donations as $donation) { 
                    fputcsv($FH, $donation);
                }
                fclose($FH);
            }; */

            $callback = function() use ($donations,$columns) 
            {
                $FH = fopen('php://output', 'w');
                fputcsv($FH, $columns);
                foreach ($donations as $donation) { 
                    $keep_in_touch = ' ';
                    foreach((json_decode($donation->additional_contact)) as $key => $val) {
                        $temp = explode(':',$val);
                        if($temp[0] == 'telephone' && $temp[1] == 'true'){
                            $keep_in_touch .= 'Contact By Phone'.',';
                        }
                        else if($temp[0] == 'email' && $temp[1] == 'true'){
                            $keep_in_touch .= 'Contact By Email'.',';
                        }
                        else if($temp[0] == 'sms' && $temp[1] == 'true'){
                            $keep_in_touch .= 'Contact By SMS'.',';
                        }
                        else if($temp[0] == 'post' && $temp[1] == 'true'){
                            $keep_in_touch .= 'Contact By Post'.',';
                        }
                    }
                    $data = [
                        $row['Donation Number']  = $donation->id,
                        $row['Donation Status']  = '',
                        $row['Donation Date']  = $donation->created_at,
                        $row['Title']  = $donation->title_name,
                        $row['First Name']  = $donation->name,
                        $row['Last Name']   = $donation->lastname,
                        $row['Company (Billing)']   = '',
                        $row['Address 1&2 (Billing)']   = $donation->address,
                        $row['City (Billing)']   = $donation->city,
                        $row['State Code (Billing)']   = '',
                        $row['Postcode (Billing)']   = $donation->postcode,
                        $row['Country Code (Billing)']   = $donation->country,
                        $row['Email (Billing)']   = $donation->email,
                        $row['Phone (Billing)']   = $donation->contact,
                        $row['Customer Note']   = $donation->additional_note,
                        $row['Keep in Touch']   = rtrim($keep_in_touch,','),
                        $row['Reclaim Gift Aid']   = (($donation->giftaid == 'true') ? 'Yes add £ '.(round((($donation->amount * 25) / 100),2)).' of my Gift Aid' : 'No, do not my Gift Aid'),
                        $row['Payment Method']   = $donation->payment_method,
                        $row['Donation Name']   = $donation->title,
                        $row['Donation Type']   = $donation->type,
                        $row['Donation Quantity']   = $donation->qty,
                        $row['Donation Line Total']   = $donation->amount,
                        $row['Donation Total Amount']   = $donation->amount,
                        
                    ];
                    
                    fputcsv($FH,$data);
                }
                fclose($FH);
            };

            return Response::stream($callback, 200, $headers);

        }  else { // export all items
            $donations = Donation::all();
            //print_r('<pre>');
            //print_r($donations);die;
            //$donations = json_decode(json_encode($donations), true);
            $headers = [
                    'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
                ,   'Content-type'        => 'text/csv'
                ,   'Content-Disposition' => 'attachment; filename=donations.csv'
                ,   'Expires'             => '0'
                ,   'Pragma'              => 'public'
            ];        
           
            # add headers for each column in the CSV download
            $columns = array('Donation Number','Donation Status','Donation Date','Title','First Name', 'Last Name'
                        ,'Company (Billing)','Address 1&2 (Billing)','City (Billing)'
                        ,'State Code (Billing)','Postcode (Billing)','Country Code (Billing)','Email (Billing)'
                        ,'Phone (Billing)','Customer Note','Keep in Touch','Reclaim Gift Aid','Payment Method'
                        ,'Donation Name','Donation Type','Donation Quantity','Donation Line Total'
                        ,'Donation Total Amount');
            //array_unshift($donations, array_keys($donations[0]));
            
            $callback = function() use ($donations,$columns) 
            {
                $FH = fopen('php://output', 'w');
                fputcsv($FH, $columns);
                
                foreach ($donations as $donation) { 
                    $keep_in_touch = ' ';
                    foreach((json_decode($donation->additional_contact)) as $key => $val) {
                        $temp = explode(':',$val);
                        if($temp[0] == 'telephone' && $temp[1] == 'true'){
                            $keep_in_touch .= 'Contact By Phone'.',';
                        }
                        else if($temp[0] == 'email' && $temp[1] == 'true'){
                            $keep_in_touch .= 'Contact By Email'.',';
                        }
                        else if($temp[0] == 'sms' && $temp[1] == 'true'){
                            $keep_in_touch .= 'Contact By SMS'.',';
                        }
                        else if($temp[0] == 'post' && $temp[1] == 'true'){
                            $keep_in_touch .= 'Contact By Post'.',';
                        }
                    }
                    
                    $data = [
                        $row['Donation Number']  = $donation->id,
                        $row['Donation Status']  = '',
                        $row['Donation Date']  = $donation->created_at,
                        $row['Title']  = $donation->title_name,
                        $row['First Name']  = $donation->name,
                        $row['Last Name']   = $donation->lastname,
                        $row['Company (Billing)']   = '',
                        $row['Address 1&2 (Billing)']   = $donation->address,
                        $row['City (Billing)']   = $donation->city,
                        $row['State Code (Billing)']   = '',
                        $row['Postcode (Billing)']   = $donation->postcode,
                        $row['Country Code (Billing)']   = $donation->country,
                        $row['Email (Billing)']   = $donation->email,
                        $row['Phone (Billing)']   = $donation->contact,
                        $row['Customer Note']   = $donation->additional_note,
                        $row['Keep in Touch']   = rtrim($keep_in_touch,','),
                        $row['Reclaim Gift Aid']   = (($donation->giftaid == 'true') ? 'Yes add £ '.(round((($donation->amount * 25) / 100),2)).' of my Gift Aid' : 'No, do not my Gift Aid'),
                        $row['Payment Method']   = $donation->payment_method,
                        $row['Donation Name']   = $donation->title,
                        $row['Donation Type']   = $donation->type,
                        $row['Donation Quantity']   = $donation->qty,
                        $row['Donation Line Total']   = $donation->amount,
                        $row['Donation Total Amount']   = $donation->amount,
                        
                    ];
                    
                    fputcsv($FH,$data);
                }
                fclose($FH);
            };
    
            return Response::stream($callback, 200, $headers);
        //     return redirect()->back();
        //     // return response('Hello World', 200)
        //     //       ->header('Content-Type', 'text/plain');
        }      
    }

}
