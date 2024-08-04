<?php

use App\Http\Controllers\postController;
use App\Http\Controllers\userController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $post = [];

    if(auth()->check()){
        $post = auth()->user()->usersCoolPosts()->latest()->get();
    }
  

    // $allpost=Post::where('user_id',Auth::user()->id)->get();
    return view('home', ['posts'=> $post]);
});


Route::post('/register',[userController::class, 'register']);
Route::post('/logout',[userController::class, 'logout']);
Route::post('/login',[userController::class, 'login']);


//Blog post routes

Route::post('/create-post',[postController::class,'createPost']);
Route::get('/edit-post/{post}',[postController::class,'showEditScreen']);
Route::put('/edit-post/{post}',[postController::class,'updatePost']);
Route::delete('/delete-post/{post}',[postController::class,'deletePost']);



