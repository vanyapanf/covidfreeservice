<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $posts = Post::all();
        $illnessesCount = Report::where('type', 'illness')->count();
        $recoveriesCount = Report::where('type', 'recovery')->count();

        return view('index', [
            'posts' => $posts,
            'illnessesCount' => $illnessesCount,
            'recoveriesCount' => $recoveriesCount
        ]);
    }

    public function getFilesByPost($post_id) {
        $post = Post::where('id', $post_id);

        $files = Storage::get($post['path_to_files']);

        return view('index', [
            'files' => $files
        ]);
    }

    public function getCommentsByPost($post_id) {
        $comments = Comment::where('post_id', $post_id)->get();

        return view('index', [
            'comments' => $comments
        ]);
    }

    public function  createComment($post_id, $user_id, $comment_text) {
        $comment = new Comment(array(
           'post_id' => $post_id,
           'user_id' => $user_id,
           'comment_text' => $comment_text
        ));

        $comment->save();

        $comments = Comment::where('post_id', $post_id)->get();

        return view('index', [
            'comments' => $comments
        ]);
    }
}
