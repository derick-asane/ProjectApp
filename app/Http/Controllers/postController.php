<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class postController extends Controller
{


    public function updatePost(Post $post, Request $request){
        if(auth()->user()->id != $post->user_id){
            return redirect('/');
        }
        $incomingFields = $request->validate([
            "title"=> "required",
            "body"=> "required",
        ]);
        $incomingFields['title']= strip_tags($incomingFields['title']);
        $incomingFields['body']= strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return redirect('/');

    }
    public function showEditScreen(Post $post){
        return view("edit-post",["post"=> $post]);
    }
    public function createPost(Request $request){
        $incomingFields = $request->validate([
            "title"=> "required",
            "body" => "required",
        ]);

        $incomingFields['title']= strip_tags($incomingFields['title']);
        $incomingFields['body']= strip_tags($incomingFields['body']);
        $incomingFields['user_id']= auth()->user()->id;

        Post::create($incomingFields);
        return redirect('/');

    }

    public function deletePost(Post $post){
        if(auth()->user()->id === $post->user_id){
            $post->delete();
        }
        return redirect('/');
    }
}
