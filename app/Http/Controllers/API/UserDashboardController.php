<?php
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\User;
use Auth;


class UserDashboardController extends Controller
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
        $donations = Donation::where('email', auth()->user()->email)
        ->groupBy('reference')
        ->orderByDesc('created_at')
        ->get();

        $donor = Donor::where('email', auth()->user()->email)
        ->first();

        return response()->json(array('donations' => $donations, 'donor' => $donor));
    }

    /**
     * Display order details page
     *
     * @return \Illuminate\Http\Response
     */
    public function donation_details($rerefence)
    {
        // dd($rerefence);
        $donations = Donation::where('email', auth()->user()->email)
        ->where('reference', $rerefence)
        ->orderBy('created_at')
        ->get();

        
        // If order exists to go the details page
        // Else redirected to the dashboard
        if(count($donations) > 0) {
            $total = Donation::where('email', auth()->user()->email)
            ->where('reference', $rerefence)
            ->sum('amount');
            
            $donor = Donor::where('email', auth()->user()->email)
            ->first();
            
            // return view('order-details', ['donations' => $donations, 'sub_total' => $total, 'donor' => $donor]);
            return response()->json(array('donations' => $donations, 'sub_total' => $total, 'donor' => $donor));
        } else {
            return redirect('/dashboard');
        }
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