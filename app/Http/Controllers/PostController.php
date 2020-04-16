<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Like;
use App\Events\MyEvent;
use App\Events\PostEvent;
use App\Events\UserPostEvent;
use Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function sendPusher(Request $request){
        // broadcast(new MyEvent( $request->input('input') ));
        $data = $request->input('data');
        dump($data );
        event(new MyEvent($data));
    }
    // public function __construct(){
    //     $this->middleware('auth');
    // }


    public function submitPost(Request $request)
    {



        if ($request->hasFile('image')) {

            $baseUrl = url('/');
            $imagename = time() . $request->file('image')->getClientOriginalName();


            $request->file('image')->storeAs('public/postImages', $imagename);
            $dbImage = $baseUrl . '/storage/postImages/' . $imagename;


            /*
            FOR 000WEBHOST CONFIG

            $request->file('image')->storeAs('storage/postImages2', $imagename, 'public_resources');
            $dbImage = $baseUrl . '/storage/postImages2/' . $imagename;

            */


            $post = new Post;
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->description = $request->input('description');
            $post->submitted_by = Auth::user()->id;
            $post->image = $dbImage;
            $post->save();
            broadcast(new PostEvent($post->id));
            // $userId = Auth::user()->id;
            broadcast(new UserPostEvent($post->submitted_by));
        } else {
            return 'false';
        }
    }

    public function getPosts()
    {
        $posts = Post::get();

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

    public function postTables()
    {
        return view('post-tables');
    }

    public function triggerMyEvent(Request $request)
    {
        event(new MyEvent('hello world ABING'));
    }

    public function updatePost(Request $request)
    {
        if ($request->hasFile('image')) {
            $baseUrl = url('/');
            $imagename = time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/postImages', $imagename);
            $dbImage = $baseUrl . '/storage/postImages/' . $imagename;

            $this->saveUpdatePost($request, $dbImage);
        } else {
            $dbImage = "";
            $this->saveUpdatePost($request, $dbImage);
        }
    }

    private function saveUpdatePost($request, $dbImage)
    {
        $updatePost = Post::find($request->input('id'));
        $updatePost->title = $request->input('title');
        $updatePost->content = $request->input('content');
        $updatePost->description = $request->input('description');
        if ($dbImage != "") {
            $updatePost->image = $dbImage;
        }
        $updatePost->save();
        broadcast(new UserPostEvent($updatePost->submitted_by));
        broadcast(new PostEvent($updatePost->id));
    }
    public function deletePost($id)
    {
        $deletePost = Post::find($id);
        $postId = $deletePost->id;
        $postSubmittedBy = $deletePost->submitted_by;
        $postImagePath = $deletePost->image;

        $baseUrl = url('/');
        $postImage = str_replace($baseUrl . '/storage', '/public', $postImagePath);
        Storage::delete($postImage);

        $deletePost->delete();
        $postLikes = Like::all()->where('post_id', $id);
        $postLikes->each(function ($row) {
            Like::destroy($row->id);
        });

        broadcast(new UserPostEvent($postSubmittedBy));
        broadcast(new PostEvent($postId));
    }
    public function likePost($postId)
    {
        if (!Auth::guest()) {
            $post = Post::find($postId);
            $postSubmittedBy = $post->submitted_by;
            $count = Like::all()->where('post_id', '=', $postId)
                ->where('user_id', '=', Auth::user()->id)
                ->count();
            if ($count == 0) {
                $like = new Like;
                $like->user_id = Auth::user()->id;
                $like->post_id = $postId;
                $like->save();
                broadcast(new UserPostEvent($postSubmittedBy));
                broadcast(new PostEvent($postId));
            } else {
                $unlike = Like::where('post_id', '=', $postId)
                    ->where('user_id', '=', Auth::user()->id);
                $unlike->delete();
                broadcast(new UserPostEvent($postSubmittedBy));
                broadcast(new PostEvent($postId));
            }
        } else {
            return 401;
        }
    }
}
