<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all();

        return response()->json([
            "status" => "success",
            "comments" => $comments
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "comment" => "required",
            "post_id" => "required|exists:posts,id"
        ]);

        $comment = Comment::create($request->all());

        return response()->json([
            "status" => "success",
            "message" => "Comment created successfully",
            "comment" => $comment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment = Comment::find($comment);

        if (is_null($comment))
        {
            return response()->json([
                "status" => "faild",
                "message" => "Sorry, the comment could not found"
            ]);
        }
        
        return response()->json([
            "status" => "success",
            "message" => "the comment has been found successfully!",
            "comment" => $comment
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            "comment" => "required",
            "post_id" => "required|exists:posts,id"
        ]);

        $comment->update($request->all());
        
        return response()->json([
            "status" => "success",
            "message" => "comment has been updated successfully",
            "comment" => $comment
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment = Comment::find($comment);

        return response()->json([
            "status" => "success",
            "message" => "the comment has been deleted successfully"
        ], 204);
    }
}
