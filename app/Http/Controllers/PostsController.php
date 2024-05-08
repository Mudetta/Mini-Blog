<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json([
            "status"  => "Success",
            "message" => "All posts fetched successfully!",
            "posts"   => $posts
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all() ,[
            "title"       => "required",
            "description" => "required",
            "user_id"     => "required|exists:users,id"
        ]);

        if($validator->fails())
        {
            return response()->json([
                "status"  => "faild",
                "message" => "Sorry, couldn't create a post. Check it again",
                "errors"  => $validator->errors()
            ]);
        }

        $post = Post::create($request->all());
        return response()->json([
            "status"  => "success",
            "message" => "Post created successfully!",
            "post"    => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = Post::find($post);

        if(is_null($post))
        {
            return response()->json([
                "status" => "faild",
                "message" => "Sorry, Post not found!"
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "post"   => $post
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'       => 'required|string',
            'description' => 'required|string',
            'user_id'     => 'required|exists:users,id'
        ]);

        $post->update($request->all());

        return response()->json([
            "status"  => "success",
            "message" => "Post updated successfully!",
            "post"    => $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post = Post::find($post);

        return response()->json([
            "status" => "success",
            "message" => "Post deleted successfully"
        ], 204);
    }
}
