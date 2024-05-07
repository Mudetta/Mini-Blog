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
                'message' => 'Posts fetched succssfully',
                'posts' => $posts
        ]);
   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            "title" => "required",
            "description" => "required",
            "user_id" => "required"
        ]);

        if ($validator -> fails())
        {
            return response()->json([
                "message" => "sorry, can not store the post",
                "error" => $validator->error()
            ]);

        }
        

        $post = Post::create($input);

        return response()->json([
            "message" => "Post added successfully",
            "post" => $post
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (is_null($post))
        {
            return response()->json([
                "message" => "Post not found"
            ]);
        }

        return response()->json([
            "message" => "post found successfully",
            "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $validator = Validator::make($input, [
            "title" => "required",
            "description" => "required",
            "user_id" => "required"
        ]);

        if ($validator -> fails())
        {
            return response()->json([
                "message" => "sorry, can not store the post",
                "error" => $validator->error()
            ]);

        }

        $post->title = "title";
        $post->description = "description";
        $post->save();

        return respnse()->json([
            "message" => "post updated successfully",
            "post"  => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return response()->json([
            "message" => "post deleted successfully"
        ]);
    }
}
