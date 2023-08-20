<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\Post as ResourcesPost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('categories')->latest()->get();

        $data = [
            'status' => 200,
            'message' => 'Data Posts',
            'data' => ResourcesPost::collection($posts)
        ];

        return response()->json($data);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $posts = Post::create($request->validated());

    
        $data = [
            'status' => 201,
            'message' => 'Created successfully',
            'data' => new ResourcesPost($posts)
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $data = [
            'status' => 200,
            'message' => 'Get data post id: ' . $post->id,
            'data' =>  new ResourcesPost($post)
        ];
        return response()->json($data);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validatedData = $request->validated();

        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->category_id = $validatedData['category_id'];

        $post->save();

        $data = [
            'status' => 201,
            'message' => 'Updated successfully',
            'data' => new ResourcesPost($post)
        ];
        return response()->json($data, 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        $data = [
            'status' => 204,
            'message' => 'Deleted successfully',
            'data' => []
        ];

        return response()->json($data);
    }
}
