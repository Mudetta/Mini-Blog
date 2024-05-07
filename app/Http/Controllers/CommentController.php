<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::all();
    }

    public function createComment(Request $request, $id)
    {
        $post = Post::find($id);
        
        $input = $request->input('comment');
        $comment = Comment::create($input);
        return response()->json([
            "comment" => $comment
        ]);
    }
}