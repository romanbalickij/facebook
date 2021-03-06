<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserImageResource extends JsonResource
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
            'data' =>[
                'type' =>'user-images',
                'user_image_id' => $this->user_id,
                'attributes' => [
                    'path'     => $this->path,
                    'width'    => $this->width,
                    'height'   => $this->height,
                    'location' => $this->location,
                ]
            ]
        ];
    }
}
