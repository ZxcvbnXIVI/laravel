<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'VideoID' => $this->VideoID,
            'SubjectID' => $this->SubjectID,
            'CategoryID' => $this->CategoryID,
            'VideoTitle' => $this->VideoTitle,
            'VideoURL' => $this->VideoURL,
            'Thumbnail' => $this->Thumbnail,
            'ChannelName' => $this->ChannelName,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'subjects' => new SubjectResource($this->whenLoaded('subjects')),
            'categories' => new CategoryResource($this->whenLoaded('categories')),
        ];
        
    }
}
