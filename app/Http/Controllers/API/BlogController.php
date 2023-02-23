<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    

    /**
     * Fetch Blogs 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getBlogs()
    {
        $blogs = Blog::get();
        return response()->json($blogs);
    }
    /**
     * Fetch Blog  Details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getBlogDetails($slug)
    {
        // fetch the package details
        $blog = Blog::where('slug', $slug)->first();
        return response()->json(array('blog' => $blog));
    }
    

}




