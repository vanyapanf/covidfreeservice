<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function post($post_id) {
        $post = Post::where('id', $post_id)->latest()->first();
        $comments = Comment::where('post_id', $post_id)->get();

        return view('web.post.index', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function  createComment($post_id, Request $request) {
        $comment = new Comment(array(
            'post_id' => $post_id,
            'user_id' => Auth::user()->id,
            'comment_text' => $request['comment']
        ));

        $comment->save();

        return redirect(route('post',['post_id' => $post_id]));
    }
}
