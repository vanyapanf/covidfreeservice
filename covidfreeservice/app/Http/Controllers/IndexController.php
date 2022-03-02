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
        $illnessesCount = Report::where('type', 'illness')->count();
        $recoveriesCount = Report::where('type', 'recovery')->count();
        $posts = Post::all();
        $comments_count = array();
        foreach ($posts as $post){
            $comments_count[$post['id']] = Comment::where('post_id', $post['id'])->count();
        }
        return view('web.index.index', [
            'posts' => $posts,
            'comments_count' => $comments_count,
            'illnessesCount' => $illnessesCount,
            'recoveriesCount' => $recoveriesCount
        ]);
    }

    /*public function getFilesByPost($post_id) {
        $post = Post::where('id', $post_id);

        $files = Storage::get($post['path_to_files']);

        return view('web.index.index', [
            'files' => $files
        ]);
    }

    public function getCommentsByPost($post_id) {
        $comments = Comment::where('post_id', $post_id)->get();

        return view('index', [
            'comments' => $comments
        ]);
    }*/
}
