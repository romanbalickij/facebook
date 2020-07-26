<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' =>  CommentResource::collection($this->collection),
            'comment_count' => $this->count(),
          //  'comment_id' => $this->id,
            'attributes' => [

            ],

            'links' => [
                'self' => url('/posts'),
            ]
        ];
    }
}
