<?php

namespace App\Http\Resources\Author;

use App\Http\Resources\Post\PostCollection;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'channel_id' => $this->channel_id,
            'created_at' => (new DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at' => (new DateTime($this->updated_at))->format('Y-m-d H:i:s'),
            'links' => [
                'self' => 'api/authors/' . $this->id,
                'all' => 'api/authors',
                'channel' => 'api/channels/' . $this->channel_id,
                'posts' => 'api/posts?author_id=' . $this->id
            ],
        ];
    }
}
