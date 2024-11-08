<?php

namespace App\Http\Controllers;


use App\Http\Requests\Channel\ChannelRequest;
use App\Http\Resources\Channel\ChannelCollection;
use App\Http\Resources\Channel\ChannelResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
//        if ($limit = $request->get('limit')) {
//            $page = 0;
//            if ($request->get('page')) {
//                $page = $request->get('page');
//            }
//            return new ChannelCollection(Channel::all()->skip($page)->take($limit));
//        } else {
            return new ChannelCollection(Channel::all());
//        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChannelRequest $request)
    {
        return new ChannelResource(Channel::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $channel = Channel::findOr($id, fn() => false);
        return $channel ? new ChannelResource($channel) : false;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChannelRequest $request, string $id)
    {
//        dd($request->all());
        $channel = Channel::findOr($id, fn() => false);
        if ($channel) {
            $success = $channel->update($request->validated());
            return ['success' => $success, 'object' => new ChannelResource($channel)];
        } else {
            return ['success' => false, 'error' => 'Channel not found'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $channel = Channel::findOr($id, fn() => false);
        if ($channel) {
            foreach ($channel->authors as $author) {
                foreach ($author->posts as $post) {
                    $post->delete();
                }
                $author->delete();
            }
            return ['success' => (bool)$channel->delete()];
        } else {
            return ['success' => true];
        }
    }
}
