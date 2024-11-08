<?php

namespace App\Http\Resources\Channel;

use App\Http\Resources\Author\AuthorCollection;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
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
            'created_at' => (new DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at' => (new DateTime($this->updated_at))->format('Y-m-d H:i:s'),
            'links' => [
                'self' => 'api/channels/' . $this->id,
                'all' => 'api/channels',
                'authors' => 'api/authors?channel_id=' . $this->id
            ],
        ];
    }
}
