<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SavePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        
        return response()->json([
            'message' => 'List of posts',
            'data' => $posts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SavePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = User::first()->id;

        $post = Post::create($data);

        return response()->json([
            'message' => 'Post created successfully',
            'data' => $post,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json([$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SavePostRequest $request, Post $post)
    {
        $data = $request->validated();

        $data['user_id'] = User::first()->id;

        $post->update($data);

        return response()->json([
            'message' => 'Post updated successfully',
            'data' => $post,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->noContent();
    }
}
