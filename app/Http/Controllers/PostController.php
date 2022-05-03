<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
//        dd(request('search'));//return value
//        dd(request(['search'])); //return arr 'search'=>value
        return view('posts',[
            'posts' => Post::latest()->filter(request(['search','category','author']))->simplePaginate(6)->withQueryString(),
            'categories'=>Category::all(),
            'currentCategory'=>Category::firstWhere('slug',request('category'))
        ]);
    }

    public function show(Post $post)
    {
        return view('/post',[
            'post'=> $post
        ]);
    }

//    public function getPosts()
//    {
//       return Post::latest()->filter()->get();
//    }
//        $posts = Post::latest();
//        if(request('search')){
//            $posts->where('title','like','%'.request('search').'%')
//                ->orWhere('body','like','%'.request('search').'%');
//        }
//        return $posts->get();
//    }
}
