<?php
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use DB;
use DateTime;
use Input;
Use Auth;
use Storage;
Use App\Models\Cfcampaign;
Use App\Models\Cfmember;
Use App\Models\Cfdonor;
Use App\Models\Cfappeal;
Use App\Models\Cfdonation;
use Redirect;
use File;
Use Mail;

class CfcampaignController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $data = $request->all();

        // for search
        if(isset($data['query']) && !empty($data['query'])){
            $data = Cfcampaign::with(['cfdonations', 'cfmembers','cfmembers.cfcampaigns.cfdonations'])->
            where('title', 'like', '%'.$data['query'].'%')
            ->orWhere('description', 'like', '%'.$data['query'].'%')
            ->orderBy('id', 'desc')->paginate(9);
        } else {
            // $data = Cfcampaign::orderBy('id', 'desc')->paginate(6);
            // $data = Cfcampaign::with(['cfdonations', 'cfmembers','cfmembers.cfcampaigns.cfdonations'])->orderBy('id', 'desc')->get();
            $data = Cfcampaign::with(['cfdonations', 'cfmembers','cfmembers.cfcampaigns.cfdonations'])->orderBy('id', 'desc')->paginate(9);
        }

        $cfappeals = Cfappeal::orderBy('order', 'desc')->get();

        // print_r($data);
        return response()->json(array('data'=> $data, 'cfappeals' => $cfappeals));
        // return view('cf/fundraising')->with(array('data'=> $data, 'cfappeal' => $cfappeal));
    }

    /**
     * Get appeals
     *
     * @return \Illuminate\Http\Response
    */
    public function getCfappeals()
    {
        // fetch the countries
        $data = Cfappeal::all();
        return response()->json($data);
    }

    /**
     * Edit campaign page
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    { 
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'goal' => 'required|max:255',
            // 'image' => 'mimes:jpeg,jpg,png,gif|max:600000' // max 6Mb
        ]); 

        if ($validator->passes()) {
            $title = strtolower($data['title']);
            $imageName = NULL;
            
            try {
                // If request has a file
                if($request->file()) {
                    $image = $request->file('image');
                    // upload file to the directory
                    if (File::exists($image)) {
                        $imageName = time().'.'.$request->image->extension();
                        $request->image->move(public_path('cfcampaigns'), $imageName);
                    }
                    // Insert data to the database with image 
                    Cfcampaign::where('id', $data['campaignid'])->update(['title' => $data['title'], 'slug' => preg_replace('/\s+/', '-', $data['title']), 'goal' => $data['goal'], 'image' => $imageName, 'description' => $data['description'] , 'is_joinbutton_public' => $data['is_joinbutton_public']]);
                } else {
                    // Insert data to the database
                    Cfcampaign::where('id', $data['campaignid'])->update(['title' => $data['title'], 'slug' => preg_replace('/\s+/', '-', $data['title']), 'goal' => $data['goal'], 'description' => $data['description'] , 'is_joinbutton_public' => $data['is_joinbutton_public']]);
                }
            } catch (\Exception $exception) {
                return response()->json([
                    // 'result' => $exception->getMessage(),
                    'result' => array("Sorry something went wrong. Please try again."),
                ], 200);
            }

            // return 'success';
            return response()->json(['result' => 'success', 'slug' => preg_replace('/\s+/', '-', $title)]);
        }

        return response()->json(['result'=>$validator->errors()->all()]);
    }

    /**
     * Delete CF campaign 
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    { 
        $deletecfcampaignid = $request->campaignid;
        try {
            $cfcampaign = Cfcampaign::find($deletecfcampaignid);
            $cfcampaign->cfmembers()->detach();
            $cfcampaign->delete(); //returns true/false
            return response()->json(['result' => 'success']);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
                // 'result' => "Sorry something went wrong. Please try again.",
            ], 200);
        }


        // $userId = Auth::id();
        // $cfmembers = Cfmember::where('user_id', $userId)->get();
        // $cfappeal = Cfappeal::orderBy('order', 'desc')->get();

        // return view('cf/dashboard')->with(array('cfmembers'=> $cfmembers, 'cfappeal' => $cfappeal ));
    }


    /**
     * Loading CF single campaign page 
     */
    public function show($slug)
    {   
        $cfcampaign = Cfcampaign::with(['cfdonations', 'cfmembers','cfmembers.cfcampaigns'])->where('slug', '=', $slug)->firstOrFail();

        $total_donations = 0;
        foreach ($cfcampaign->cfdonations as $key => $value){
            $total_donations += $value->amount;
        }

        // team members total
        $total_member_donations = 0;
        foreach ($cfcampaign->cfmembers as $key => $value) {
            if(count($value->cfcampaigns) > 0) {
                foreach ($value->cfcampaigns as $key => $value) 
                if($value->is_member == 'yes') {
                    foreach ($value->cfdonations as $key => $donation) {
                        $total_member_donations += $donation->amount;
                    }
                }
            }
        }

        // if team
        if($cfcampaign->is_team == 'yes'){
            $total_donations = $total_donations + $total_member_donations;
        }

        $cfappeal = Cfappeal::where('name', '=', $cfcampaign->apeal)->orderBy('order', 'desc')->get();

        return response()->json(array('cfcampaign' => $cfcampaign, 'total_donations' => $total_donations, 'cfappeal' => $cfappeal));

    }

    // /**
    //  * Join team
    //  */
    // public function join_team(Request $request)
    // {   
    //     $data = $request->all();
    //     return view('cf/join-team')->with(array('data'=> $data));
    // }

     /**
     * Submit join team
     */
    public function join_team_submit(Request $request)
    {   
        $data = $request->form;
        
        $cfcampaign = Cfcampaign::where('id', '=', $data['campaignid'])->firstOrFail();

        if(count($cfcampaign->cfmembers) > 0) {
            foreach ($cfcampaign->cfmembers as $key => $value) {
                $data['authorid'] = $value->id;
                $data['authorname'] = $value->firstname;
                $data['authoremail'] = $value->email;
            }
          
        }

        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'goal' => 'required|max:255'
        ]);

        if ($validator->passes()) { 
            // if user logged in
            if (Auth::user()) {

                $user = Auth::user();
                $title = strtolower($data['title']);

                try {
                    $result = Cfcampaign::create([
                        'title' => $data['title'],
                        'slug' => preg_replace('/\s+/', '-', $title),
                        'goal' => $data['goal'],
                        'apeal' => $data['appeal'],
                        'author' => Auth::user()->name,
                        'is_team' => 'no',
                        'is_member' => $data['is_member'],
                        'member_id' => $user->id,
                        'team_id' => $data['campaignid'],
                    ]);

                    // joining to a campaign
                    $Cfmember = Cfmember::where('user_id', $user->id)->firstOrFail();
                    $Cfmember->cfcampaigns()->attach($data['campaignid']);

                    // user campaign
                    $user = Auth::user(); 
                    $Cfmember = Cfmember::where('user_id', $user->id)->firstOrFail();
                    $Cfmember->cfcampaigns()->attach($result->id);
                    
                } catch (\Exception $exception) {
                    return response()->json([
                        // 'result' => $exception->getMessage(),
                        'result' => "Sorry something went wrong. Please try again.",
                    ], 200);
                }

                try {
                    // sending email  
                    $sender_name = Auth::user()->name;
                    $sender_email =  Auth::user()->email;
                    $team_author_email = $data['authoremail'];
                    // To site admin
                    Mail::send('emails/cf.cf-team-admin-receive-join-team', array('data' =>$data ), function ($message) use ($sender_name, $sender_email, $team_author_email) {
                        $message->from($sender_email, $sender_name);
                        $message->subject('Someone has joined your team');
                        $message->to($team_author_email);
                    });

                } catch (\Exception $exception) {
                    return response()->json([
                        // 'result' => $exception->getMessage(),
                        'result' => "Campaign is created successfully but the problem is sending you the confirmation email",
                        'slug' => preg_replace('/\s+/', '-', $data['title'])
                    ], 200);
                }

                return response()->json(['result' => 'loggedin', 'slug' => preg_replace('/\s+/', '-', $data['title'])]);

            } else {
                // Store a piece of data in the session
                session(['cfindivisualcampaigndata' => $data]);
                return response()->json(['result' => 'notloggedin']);
            }
            
        } 
        return response()->json(['error'=>$validator->errors()->all()]);
        
    }

    /**
     * Create new cf campaign
     *
     * @return \Illuminate\Http\Response
     */
    public function create_cf_campaign(Request $request)
    { 
        $data = $request->form;

        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'goal' => 'required|max:255'
        ]);

        if ($validator->passes()) {
            // For the logged in user
            if (Auth::user()) {
                $user = Auth::user(); 
                $title = strtolower($data['title']);
                try {
                    $result = Cfcampaign::create([
                        'title' => $data['title'],
                        'slug' => preg_replace('/\s+/', '-', $title),
                        'goal' => $data['goal'],
                        'apeal' => $data['appeal'],
                        'author' => Auth::user()->name,
                        'is_team' => $data['is_team'],
                        // 'is_member' => $data['is_member'],
                        'member_id' => $user->id,
                    ]);
                    
                    // Insert to the pivot data
                    $Cfmember = Cfmember::where('user_id', $user->id)->firstOrFail();
                    $Cfmember->cfcampaigns()->attach($result->id);

                } catch (\Exception $exception) {
                    return response()->json([
                        'result' => $exception->getMessage(),
                        // 'result' => "Sorry something went wrong. Please try again.",
                    ], 200);
                }

                try { 
                    // Sending email  
                    $data['name'] = Auth::user()->name;
                    $data['email'] = Auth::user()->email; 
                    $sender_name = $data['name'];
                    $sender_email = $data['email'];
                    
                    // To the site admin
                    Mail::send('emails/cf.cf-admin-new-campaign', array('data' =>$data ), function ($message) use ($sender_name, $sender_email) {
                        $message->from($sender_email, $sender_name);
                        $message->subject('A new campaign page has been created');
                        $message->to('mamunur.play@gmail.com');
                    });

                    // To the campaigner: confirmation email
                    Mail::send('emails/cf.cf-campaigner-thankyou', array('data' =>$data ), function ($message) use ($sender_name, $sender_email) {
                        $message->from('info@charityplatform.com', 'Charity platform fundraising');
                        $message->subject('Your fundraising page is live and ready');
                        $message->to($sender_email);
                    });
                } catch (\Exception $exception) {
                    return response()->json([
                        // 'result' => $exception->getMessage(),
                        'result' => "Campaign is created successfully but the problem is sending you the confirmation email",
                        'slug' => preg_replace('/\s+/', '-', $title)
                    ], 200);
                }
                    
                return response()->json(['result' => 'loggedin', 'slug' => preg_replace('/\s+/', '-', $title)]);

                
            } else {

                // Store a piece of data in the session
                session(['cfindivisualcampaigndata' => $data]);

                return response()->json(['result' => 'notloggedin']);
            }
            
        } 
        return response()->json(['error'=>$validator->errors()->all()]);
       
    }

}