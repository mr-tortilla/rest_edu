<?php

namespace App\Http\Resources\Channel;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChannelCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $result = [];
        foreach ($data as $channel) {

            $result[] = [
                'id' => $channel['id'],
                'name' => $channel['name'],
                'created_at' => (new DateTime($channel['created_at']))->format('Y-m-d H:i:s'),
                'updated_at' => (new DateTime($channel['updated_at']))->format('Y-m-d H:i:s')
            ];
        }
        return $result;
    }
}
