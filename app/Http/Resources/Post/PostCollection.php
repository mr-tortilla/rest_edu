<?php

namespace App\Http\Resources\Post;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
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
        foreach ($data as $post) {

            $result[] = [
                'id' => $post['id'],
                'title' => $post['title'],
                'author_id' => $post['author_id'],
                'created_at' => (new DateTime($post['created_at']))->format('Y-m-d H:i:s'),
                'updated_at' => (new DateTime($post['updated_at']))->format('Y-m-d H:i:s'),
            ];
        }
        return $result;
    }
}
