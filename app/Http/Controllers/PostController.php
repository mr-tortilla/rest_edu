<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostRequest;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Author;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($author_id = $request->get('author_id')) {
            return new PostCollection(Post::where(['author_id' => $author_id])->get());
        } else {
            return new PostCollection(Post::all());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $create_data = $request->validated();
        $channel = Author::findOr($create_data['author_id'], fn() => false);
        if ($channel) {
            $author = Post::create($request->validated());
            if ($author) {
                return ['success' => true, 'object' => new PostResource($author)];
            } else {
                return ['success' => false];
            }
        } else {
            return ['success' => false, 'error' => 'Related author does not exists'];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOr($id, fn() => false);
        return $post ? new PostResource($post) : false;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $post = Post::findOr($id, fn() => false);
        if ($post) {
            $update_data = $request->validated();
            if ($update_data) {
                if ($author_id = $update_data['author_id']) {
                    $author = Author::findOr($author_id, fn() => false);
                    if (!$author) {
                        return ['success' => false, 'error' => 'Related author does not exists'];
                    }
                }
                $success = $post->update();
                return ['success' => $success, 'object' => new PostResource($post)];
            } else {
                return ['success' => false, 'error' => 'No data for update'];
            }
        } else {
            return ['success' => false, 'error' => 'Post not found'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return ['success' => (bool)Post::destroy($id)];
    }
}
