<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
Use App\Models\Cfmember;
Use App\Models\Cfcampaign;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        // Retrieve a piece of data from the session
        $cf_campaign_session_data = session('cfindivisualcampaigndata');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]));

        event(new Registered($user));

        // Create cf memeber
         $cfmember = Cfmember::create([
            'user_id' => $user->id,
            'type' => 'individual',
            'firstname' => $data['name'],
            'lastname' => $data['name'],
            'email' => $data['email']
        ]);

        // If cf campaign session data exists then create a new campaign
        if($cf_campaign_session_data) { 
            $title = strtolower($cf_campaign_session_data['title']);

            // Only for joining a team
            if(isset($cf_campaign_session_data['campaignid']) && !empty($cf_campaign_session_data['campaignid'])){
                try {
                     $result = Cfcampaign::create([
                    'title' => $cf_campaign_session_data['title'],
                    'slug' => preg_replace('/\s+/', '-', $title),
                    'goal' => $cf_campaign_session_data['goal'],
                    'apeal' => $cf_campaign_session_data['appeal'],
                    'author' => $user->name,
                    'is_member' => $cf_campaign_session_data['is_member'],
                    'is_team' => $cf_campaign_session_data['is_team'],
                    'member_id' => $user->id,
                    'team_id' => $cf_campaign_session_data['campaignid'],
                    ]);

                    // Insert to the pivot data
                    $Cfmember = Cfmember::where('user_id', $user->id)->firstOrFail();
                    $Cfmember->cfcampaigns()->attach($cf_campaign_session_data['campaignid']);

                    // Insert to the pivot data
                    $Cfmember = Cfmember::where('user_id', $user->id)->firstOrFail();
                    $Cfmember->cfcampaigns()->attach($result->id);

                } catch (\Exception $exception) {
                    return response()->json([
                        'result' => $exception->getMessage(),
                        'result' => "Sorry something went wrong. Please try again.",
                    ], 200);
                }

                try {
                    // Sending email  
                    $sender_name = $user->name;
                    $sender_email =  $user->email;
                    $team_author_email = $cf_campaign_session_data['authoremail'];
                    // To the site admin
                    Mail::send('emails/cf.cf-team-admin-receive-join-team', array('data' =>$cf_campaign_session_data ), function ($message) use ($sender_name, $sender_email, $team_author_email) {
                        $message->from($sender_email, $sender_name);
                        $message->subject('Someone has joined your team');
                        $message->to($team_author_email);
                    });

                    
                    } catch (\Exception $exception) {
                        // return response()->json([
                        //     // 'result' => $exception->getMessage(),
                        //     'result' => "Campaign is created successfully but the problem is sending you the confirmation email",
                        //     'slug' => preg_replace('/\s+/', '-', $title)
                        // ], 200);
                        // Session destroy
                        $request->session()->forget('cfindivisualcampaigndata');
                        return redirect('/fundraising/'.preg_replace('/\s+/', '-', $title));
                    }
            } else {
                try {
                    $result = Cfcampaign::create([
                        'title' => $cf_campaign_session_data['title'],
                        'slug' => preg_replace('/\s+/', '-', $title),
                        'goal' => $cf_campaign_session_data['goal'],
                        'apeal' => $cf_campaign_session_data['appeal'],
                        'author' => $user->name,
                        'is_member' => $cf_campaign_session_data['is_member'],
                        'is_team' => $cf_campaign_session_data['is_team'],
                        'member_id' => $user->id,
                    ]);

                    // Insert to the pivot data
                    $Cfmember = Cfmember::where('user_id', $user->id)->firstOrFail();
                    $Cfmember->cfcampaigns()->attach($result->id);

                } catch (\Exception $exception) {
                    return response()->json([
                        // 'result' => $exception->getMessage(),
                        'result' => "Sorry something went wrong. Please try again.",
                    ], 200);
                }
                
                try { 
                    // Sending email  
                    $cf_campaign_session_data['name'] = $user->name;
                    $cf_campaign_session_data['email'] = $user->email; 
                    $sender_name = $user->name;
                    $sender_email = $user->email; 

                    // To the site admin
                    Mail::send('emails/cf.cf-admin-new-campaign', array('data' =>$cf_campaign_session_data ), function ($message) use ($sender_name, $sender_email) {
                        $message->from($sender_email, $sender_name);
                        $message->subject('A new campaign page has been created');
                        $message->to('mamunur.play@gmail.com');
                    });

                    // To the campaigner: confirmation email
                    Mail::send('emails/cf.cf-campaigner-thankyou', array('data' =>$cf_campaign_session_data ), function ($message) use ($sender_name, $sender_email) {
                        $message->from('info@charityplatform.com', 'Charity platform fundraising');
                        $message->subject('Your fundraising page is live and ready');
                        $message->to($sender_email);
                    });

                } catch (\Exception $exception) {
                    // return response()->json([
                    //     // 'result' => $exception->getMessage(),
                    //     'result' => "Campaign is created successfully but the problem is sending you the confirmation email",
                    //     'slug' => preg_replace('/\s+/', '-', $title)
                    // ], 200);
                    // Session destroy
                    $request->session()->forget('cfindivisualcampaigndata');
                    return redirect('/fundraising/'.preg_replace('/\s+/', '-', $title));
                }
                
            }
            
            // Session destroy
            $request->session()->forget('cfindivisualcampaigndata');
            
            // Redirect to the cf campaign single page
            return redirect('/fundraising/'.preg_replace('/\s+/', '-', $title));
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
