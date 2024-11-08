<?php

namespace App\Http\Resources\Author;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorCollection extends ResourceCollection
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
        foreach ($data as $author) {
            $result[] = [
                'id' => $author['id'],
                'name' => $author['name'],
                'channel_id' => $author['channel_id'],
                'created_at' => (new DateTime($author['created_at']))->format('Y-m-d H:i:s'),
                'updated_at' => (new DateTime($author['updated_at']))->format('Y-m-d H:i:s'),
            ];
        }
        return $result;
    }
}
