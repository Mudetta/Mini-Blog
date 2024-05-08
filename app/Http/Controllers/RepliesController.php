<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $replies = Reply::all();
        
        return response()->json([
            "status" => "success",
            "message" => "All Replies",
            "replies" => $replies
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "reply" => "required",
            "comment_id" => "required|exists:comments,id"  
        ]);

        $reply = Reply::create($request->all());

        return response()->json([
            "status" => "success",
            "message" => "reply created successfully",
            "reply" => $reply
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reply $reply)
    {
        $reply = Reply::find($reply);

        if (is_null($reply))
        {
            return response()->json([
                "status" => "faild",
                "message" => "Sorry, the reply could not found"
            ]);
        }
        
        return response()->json([
            "status" => "success",
            "message" => "the reply has been found successfully!",
            "reply" => $reply
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reply $reply)
    {
        $request->validate([
            "reply" => "required",
            'comment_id' => 'required|exists:comments,id'
        ]);

        $reply->update($request->all());
        
        return response()->json([
            "status" => "success",
            "message" => "reply has been updated successfully",
            "reply" => $reply
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reply $reply)
    {
        $reply = Reply::find($reply);

        return response()->json([
            "status" => "success",
            "message" => "the reply has been deleted successfully"
        ], 204);
    }
}
