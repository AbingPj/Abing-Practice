<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Post;


class PostPaginationController extends Controller
{
    



    public function index()
    {


        $request = request(); 
        // $query = app(Post::class)->newQuery();
        $query = Post::join('users', 'posts.submitted_by', 'users.id' )
                ->select(
                    'posts.id AS id',
                    'posts.title AS title',
                    'posts.content AS content',
                    'posts.description AS description',
                    'posts.image AS image',
                    'users.name AS submitted_by'
                )
                ->newQuery();
       
     
            if (request('sort') != "" ){
                // handle multisort
                $sorts = explode(',', request()->sort);
                foreach ($sorts as $sort) {
                    list($sortCol, $sortDir) = explode('|', $sort);
                    $query = $query->orderBy( $sortCol, $sortDir);
                }
            } else {
                $query = $query->orderBy('id', 'asc');
            }


             if ($request->exists('filter')) {
                 $query->where(function($q) use($request) {
                     $value = "%{$request->filter}%";
                     $q->where('posts.id', 'like', $value)
                         ->orWhere('posts.title', 'like', $value)
                         ->orWhere('posts.description', 'like', $value)
                         ->orWhere('users.name', 'like', $value);
                 });
             }
            
              $perPage = request()->has('per_page') ? (int) request()->per_page : null;
              // $pagination = $query->with('address')->paginate($perPage);
               
              $pagination = $query->paginate($perPage);

              $pagination->appends([
                  'sort' => request()->sort,
                  'filter' => request()->filter,
                  'per_page' => request()->per_page
              ]);
            return response()->json(
                   $pagination
                )
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET');
    }

    public function indeeexxx(Request $request)
    { 

        $per_page = request('per_page');
        $filter = request('filter');
        $posts = "";
        if( $filter != ''){
            $newposts =  new Post;
            $newposts::where('title','like', '%'.$filter.'%')->get();
            // $newposts::paginate($per_page);
            return response()->json($newposts);
            // $posts = Post::All()=where('title', '=', $filter);
        }else{
            if ( request('sort') != '' ){
                $sort= request('sort');
                $sortArr= explode('|',$sort, 2);
                $sortName = $sortArr[0];
                $sortOrder = $sortArr[1];
                $posts = Post::orderBy( $sortName,  $sortOrder)->paginate($per_page);
            }else{
                $posts = Post::paginate($per_page);
            }
            return response()->json($posts);
        }
    }

}
