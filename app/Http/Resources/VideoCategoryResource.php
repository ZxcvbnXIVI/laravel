<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'video_id' => $this->video_id,
            'category_id' => $this->category_id,
            'video' => new VideoResource($this->whenLoaded('video')),
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
