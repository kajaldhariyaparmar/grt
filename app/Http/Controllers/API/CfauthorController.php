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


class CfauthorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

     /**
     * Public author profile
     * @return \Illuminate\Http\Response
     */
    public function author_profile($id)
    {  
        $cfmembers = Cfmember::with(['cfcampaigns','cfcampaigns.cfdonations','cfcampaigns.cfmembers.cfcampaigns.cfdonations' ])->where('user_id', $id)->orderBy('id', 'desc')->get();
        $cfappeals = Cfappeal::orderBy('order', 'desc')->get();
        return response()->json(array('cfmembers' => $cfmembers, 'cfappeals' => $cfappeals));
    }
}

