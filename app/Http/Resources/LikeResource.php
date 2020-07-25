<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'likes',
                'like_id' => $this->id,
                'like_count' => $this->count(),
                'user_likes_post' =>auth()->user()->likedPosts()->where('post_id', $this->pivot->post_id)->count(),
                'attributes' => []
            ],
            'links' => [
                'self' => url('/posts/'.$this->pivot->post_id)
            ]
        ];
    }
}
