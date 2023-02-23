<?php
 
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
 
use App\Models\Post;

use App\Models\Category;
 
use Illuminate\Http\Request;
 
use Validator;
 
class PostController extends Controller
{
    // all posts
    public function index()
    {
        // $posts = Post::all()->toArray();
        // return array_reverse($posts);
        $posts = Post::where('status', 'published')->where('featured', 1)->take(3)->orderBy('order', 'desc')->get();
        return response()->json($posts);
    }

    /**
     * Fetch the posts and their attached categories
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterPosts(Request $request)
    {
        // print_r($request->all());
        $category_id = $request->category_id; 
        $sortby = $request->sortby;
        
        // fetch the campaigns and their attached countries & projects based on dropdown values
        $data = Post::whereHas('categories', function($query) use($category_id) {
            $category_id ? $query->where('category_id', '=', $category_id): '';
        })->where('status', 'published')->orderBy('created_at', $sortby)->get();

        return response()->json($data);
    }

    /**
     * Get categories
     *
     * @return \Illuminate\Http\Response
    */
    public function getCategories()
    {
        // fetch the categories
        $data = Category::all();
        return response()->json($data);
    }

    // add post
    public function add(Request $request)
    {
        $post = new Post([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);
        $post->save();
 
        return response()->json('The post successfully added');
    }
 
    // edit post
    public function edit($slug)
    {
        // fetch the post
        $post = Post::where('slug', $slug)->first();
        // fetch the latest posts
        $latestposts = Post::where('status', 'published')->take(10)->orderBy('created_at', 'desc')->get();
        // fetch the categories
        $categories = Category::withCount('posts')->get();
        return response()->json(array('post' => $post, 'latestposts' => $latestposts, 'categories' => $categories));
    }
 
    // update post
    public function update($id, Request $request)
    {
        $post = Post::find($id);
        $post->update($request->all());
 
        return response()->json('The post successfully updated');
    }
 
    // delete post
    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
 
        return response()->json('The post successfully deleted');
    }
}