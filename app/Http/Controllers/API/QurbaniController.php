<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\QurbaniPack;
use Illuminate\Http\Request;

class QurbaniController extends Controller
{
    

    /**
     * Fetch Qurbani Packs
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPacks()
    {
        $packages = QurbaniPack::get();
        return response()->json($packages);
    }
    /**
     * Fetch Qurbani Packs Details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPackDetails($slug)
    {
        // fetch the package details
        $pack = QurbaniPack::where('slug', $slug)->first();
        return response()->json(array('package' => $pack));
    }

}




