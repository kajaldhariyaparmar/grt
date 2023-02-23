<?php
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cfcampaign;
use App\Models\Cfmember;
use App\Models\Cfdonor;
use App\Models\Cfappeal;
use App\Models\Cfdonation;
use Auth;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $userId = Auth::id();
        
        $cfmembers = Cfmember::with(['cfcampaigns','cfcampaigns.cfdonations','cfcampaigns.cfmembers.cfcampaigns.cfdonations' ])->where('user_id', $userId)->orderBy('id', 'desc')->get();
        $cfappeals = Cfappeal::orderBy('order', 'desc')->get();

        return response()->json(array('cfmembers' => $cfmembers, 'cfappeals' => $cfappeals));
    }

    /**
    * Loading single order
    */
    public function show($orderId)
    { 
        $order = Order::where('id', '=', $orderId)->where('user_id', '=', Auth::id())->firstOrFail();
        return view('order')->with(array('order'=> $order ));
    }

    /**
    * Update profile
    */
    public function update_profile(Request $request)
    { 
        if($request->ajax()) {
            $user = Auth::user(); 
            $data = $request->all();
            if(empty($data['password'])){
                $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email'
                ]);

                if ($validator->passes()) {
                    User::where('id', $user->id)->update(['name' => $data['name'],'email' => $data['email']]); 
                    Customer::where('user_id', $user->id)->update(['address' => $data['address'],'city' => $data['city'],'postcode' => $data['postcode'],'country' => $data['country'],'phone' => $data['phone']]); 
                }
                return response()->json(['error'=>$validator->errors()->all()]);
            } else {
                $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:6'
                ]);
                if ($validator->passes()) {
                    User::where('id', $user->id)->update(['name' => $data['name'],'email' => $data['email'], 'password' => bcrypt($data['password'])]);
                    Customer::where('user_id', $user->id)->update(['address' => $data['address'],'city' => $data['city'],'postcode' => $data['postcode'],'country' => $data['country'],'phone' => $data['phone']]); 
                }
                return response()->json(['error'=>$validator->errors()->all()]);
            }
        }
    }

}