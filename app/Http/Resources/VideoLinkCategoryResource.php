<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoLinkCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'VideoID' => $this->VideoID,
            'CategoryID' => $this->CategoryID,
            'video' => new VideoResource($this->whenLoaded('video')),
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}