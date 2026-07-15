<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SavePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $posts = $user->posts()->paginate();
        return PostResource::collection($posts);

        /**
         * Use this if you want to include the user relationship in the response. Make sure to eager load the user relationship in the Post model.
         */
        // $posts = $user->posts()->with('user')->paginate();
    }

    public function store(SavePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = User::first()->id;

        $post = Post::create($data);

        return new PostResource($post);
    }

    public function show(Post $post)
    {
        $user = request()->user();

        abort_if(Auth::id() !== $post->user_id, 404, 'Address not found.');
        // abort(403, 'Access Forbidden.'); // Even though correct, avoid using 403 to prevent information disclosure about the existence of the resource
        
        return new PostResource($post);
    }

    public function update(SavePostRequest $request, Post $post)
    {
        abort_if(Auth::id() !== $post->user_id, 404, 'Address not found.');
        
        $data = $request->validated();

        $data['user_id'] = User::first()->id;

        $post->update($data);

        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        abort_if(Auth::id() !== $post->user_id, 404, 'Address not found.');

        $post->delete();

        return response()->noContent();
    }
}
