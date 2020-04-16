<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Like;

class UserPostsController extends Controller
{


    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function index($id)
    {

        $username = User::find($id)->name;

        if (Auth::guest()) {
            return view('user-posts', ['username' => $username, 'id' => $id, 'guest' => "true"]);
        } else {
            $currentUser =  Auth::user()->id;
            if ($id ==  $currentUser) {
                return view('user-posts', ['username' => $username, 'id' => $id, 'guest' => "false"]);
            } else {
                return view('user-posts', ['username' => $username, 'id' => $id, 'guest' => "true"]);
            }
        }
    }

    public function getUserPosts($id)
    {
        $posts = User::find($id)->posts;
        $currentUser = $id;



        // if ($posts->isNotEmpty()) {
        //     foreach ($posts as $key => $post) {
        //         $post->likes = Like::all()->where('post_id', '=', $post->id)->count();
        //         $post->like = false;
        //         $likes = Like::get();
        //         if ($likes->isNotEmpty()) {
        //             foreach ($likes as $key => $like) {
        //                 if ($like->post_id == $post->id) {
        //                     if ($like->user_id == $currentUser) {
        //                         $post->like = true;
        //                         break;
        //                     }
        //                 }
        //             }
        //         }
        //         // $post->submitted_by = $post->user->name;
        //     }
        // }
        // return response()->json($posts)
        //     ->header('Access-Control-Allow-Origin', '*')
        //     ->header('Access-Control-Allow-Methods', 'GET');;






        $posts = User::find($id)->posts;
        // $posts = Post::get();

        foreach ($posts as $key => $post) {
            $post->likes = Like::all()->where('post_id', '=', $post->id)->count();
            $post->like = false;
            $likes = Like::get();
            foreach ($likes as $key => $like) {
                if ($like->post_id == $post->id) {
                    if (!Auth::guest()) {
                        if ($like->user_id == Auth::user()->id) {
                            $post->like = true;
                            break;
                        }
                    }
                }
            }
            $post->submitted_by = $post->user->name;
        }
        return response()->json($posts);
    }
}
