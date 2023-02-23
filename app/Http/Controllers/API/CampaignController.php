<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Country;
use App\Models\Project;
use App\Models\Appeal;
use App\Models\Quickdonateappeal;
use App\Models\Post;

class CampaignController extends Controller
{
    /**
     * Fetch published campaigns
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $campaigns = Campaign::all()->toArray();
        // return array_reverse($campaigns);
        $campaigns = Campaign::where('status', 'published')->where('is_featured', 1)->take(6)->orderBy('order', 'desc')->get();
        return response()->json($campaigns);
    }

    /**
     * Fetch published and featured campaigns for home slides
     *
     * @return \Illuminate\Http\Response
     */
    public function getSlideCampaigns()
    {
        $campaigns = Campaign::where('status', 'published')->where('slide', 1)->orderBy('order', 'desc')->get();
        return response()->json($campaigns);
    }

    /**
     * Fetch the campaigns and their attached countries & projects
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCampaigns($slug)
    {
        // Defalt values
        $country_id = 0;
        $project_id = 0;

        // Checking empty slug
        if(isset($slug) && !empty($slug)) { 
            // is slug = project or country
            $is_project = Project::where('slug', $slug)->first();
            $is_country = Country::where('slug', $slug)->first();
            
            if($is_project) {
                $project_id = $is_project->id;
                $country_id = 0;
            }
            if($is_country) {
                $country_id = $is_country->id;
                $project_id = 0;
            }
        } else { 
            $country_id = 0;
            $project_id = 0;
        }
       
        // fetch the campaigns and their attached countries & projects based on dropdown values
        $data = Campaign::whereHas('countries', function($query) use($country_id) {
            $country_id ? $query->where('country_id', '=', $country_id): '';
        })->whereHas('projects', function($query) use($project_id) {
            $project_id ? $query->where('project_id', '=', $project_id): '';
        })->where('status', 'published')->orderBy('order', 'desc')->get();
        return response()->json(array('data' => $data, 'project' => $project_id, 'country' => $country_id ));
    }

    public function getDropdownCampaigns(Request $request)
    {
        // Default values
        $country_id = 0;
        $project_id = 0;

         // is slug = project or country
         $is_project = Project::where('slug', $request->project_id)->first();
         $is_country = Country::where('slug', $request->country_id)->first();
         
         if($is_project) {
             $project_id = $is_project->id;
             $country_id = 0;
         }
         if($is_country) {
             $country_id = $is_country->id;
             $project_id = 0;
         }
        
        // fetch the campaigns and their attached countries & projects based on dropdown values
        $data = Campaign::whereHas('countries', function($query) use($country_id) {
            $country_id ? $query->where('country_id', '=', $country_id): '';
        })->whereHas('projects', function($query) use($project_id) {
            $project_id ? $query->where('project_id', '=', $project_id): '';
        })->where('status', 'published')->orderBy('order', 'desc')->get();
        return response()->json(array('data' => $data, 'project' => $project_id, 'country' => $country_id ));
    }

    // public function getCampaigns(Request $request)
    // {
    //     // print_r($request->all());
    //     $project_id = $request->project_id; 
    //     $country_id = $request->country_id;
        
    //     // fetch the campaigns and their attached countries & projects based on dropdown values
    //     $data = Campaign::whereHas('countries', function($query) use($country_id) {
    //         $country_id ? $query->where('country_id', '=', $country_id): '';
    //     })->whereHas('projects', function($query) use($project_id) {
    //         $project_id ? $query->where('project_id', '=', $project_id): '';
    //     })->where('status', 'published')->orderBy('order', 'desc')->get();
    //     return response()->json($data);
    // }

    /**
     * Campaign single page
     *
     * @return \Illuminate\Http\Response
     */
    public function single($slug)
    {
        // fetch the campaign
        $campaign = Campaign::with('posts')->where('slug', $slug)->first();
        // fetch the related campaigns
        $related = Campaign::whereHas('projects', function ($q) use ($campaign) {
            return $q->whereIn('id', $campaign->projects->pluck('id')); 
        })->whereHas('countries', function ($q) use ($campaign) {
            return $q->whereIn('id', $campaign->countries->pluck('id')); 
        })
        ->where('id', '!=', $campaign->id) // So you won't fetch same campaign
        ->take(3)->get();
        return response()->json(array('campaign' => $campaign, 'relatedcampaigns' => $related));
    }

    /**
     * Get projects
     *
     * @return \Illuminate\Http\Response
     */
    public function getProjects()
    {
        // fetch the projects
        $data = Project::all();
        return response()->json($data);
    }

     /**
     * Get countries
     *
     * @return \Illuminate\Http\Response
     */
    public function getCountries()
    {
        // fetch the countries
        $data = Country::all();
        return response()->json($data);
    }

    /**
     * Get appeals
     *
     * @return \Illuminate\Http\Response
    */
    public function getAppeals()
    {
        // fetch the countries
        $data = Appeal::all();
        return response()->json($data);
    }

     /**
     * Get quick donate appeals
     *
     * @return \Illuminate\Http\Response
    */
    public function getQuickAppeals()
    {
        // fetch the countries
        $data = Quickdonateappeal::all();
        return response()->json($data);
    }

    /**
     * Get admin cost value
     *
     */
    public function getAdminCost()
    {
        return setting('site.admincost');
    }

}
