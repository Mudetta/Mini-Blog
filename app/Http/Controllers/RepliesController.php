<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function index()
    {
        $replies = Reply::all();
    }

    public function createComment(Request $request, $id)
    {
        $post = Post::find($id);
        $comment = Comment::find($id);
        
        $input = $request->input('reply');
        $comment = Reply::create($input);
        return response()->json([
            "reply" => $reply
        ]);
    }
}
