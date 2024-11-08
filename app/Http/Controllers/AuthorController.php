<?php

namespace App\Http\Controllers;

use App\Http\Requests\Author\AuthorRequest;
use App\Http\Resources\Author\AuthorCollection;
use App\Http\Resources\Author\AuthorResource;
use App\Models\Author;
use App\Models\Channel;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($channel_id = $request->get('channel_id')) {
            return new AuthorCollection(Author::where(['channel_id' => $channel_id])->get());
        } else {
            return new AuthorCollection(Author::all());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request)
    {
        $create_data = $request->validated();
        $channel = Channel::findOr($create_data['channel_id'], fn() => false);
        if ($channel) {
            $author = Author::create($request->validated());
            if ($author) {
                return ['success' => true, 'object' => new AuthorResource($author)];
            } else {
                return ['success' => false];
            }
        } else {
            return ['success' => false, 'error' => 'Related channel does not exists'];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = Author::findOr($id, fn() => false);
        return $author ? new AuthorResource($author) : false;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorRequest $request, string $id)
    {
        $author = Author::findOr($id, fn() => false);
        if ($author) {
            $update_data = $request->validated();
            if ($update_data) {
                if ($channel_id = $update_data['channel_id']) {
                    $channel = Channel::findOr($channel_id, fn() => false);
                    if (!$channel) {
                        return ['success' => false, 'error' => 'Related channel does not exists'];
                    }
                }
                $success = $author->update($update_data);
                if ($success) {
                    return ['success' => true, 'object' => new AuthorResource($author)];
                } else {
                    return ['success' => false];
                }
            } else {
                return ['success' => false, 'error' => 'No data for update'];
            }
        } else {
            return ['success' => false, 'error' => 'Author not found'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::findOr($id, fn() => false);
        if ($author) {
            foreach ($author->posts as $post) {
                $post->delete();
            }
            return ['success' => (bool)$author->delete()];
        } else {
            return ['success' => true];
        }
    }
}
