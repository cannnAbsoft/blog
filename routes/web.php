<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Post_Old;
use App\Models\Category;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class,'index']
//    \Illuminate\Support\Facades\DB::listen(function ($query){
//        logger($query->sql, $query->bindings);
//    });
)->name('home');

Route::get('/post/{post:slug}', [PostController::class, 'show']
//Post::where('slug',$post)
);
Route::get('/categories/{category:slug}', function (Category $category){
    return view('posts',[
        'posts'=> $category->posts,
        'currentCategory' => $category,
        'categories'=>Category::all()
    ]);

});
Route::get('/author/{author:userName}', function (User $author){
    return view('posts',[
        'posts'=> $author->posts,
        'categories'=>Category::all()
    ]);

});

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');
//Route::get('/post/{post}', function ($id){
//    // get post by slug and return post
//    $post = Post::findOrFail($id);
//    return view('/post',[
//       'post'=> $post
//    ]);
//});
Route::get('/login',[SessionsController::class, 'create'])->middleware('guest');
Route::post('/login',[SessionsController::class, 'store'])->middleware('guest');
Route::post('/logout',[SessionsController::class, 'destroy'])->middleware('auth');

