<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    public function toArray($request)
    {
        // return [
        //     'VideoID' => $this->VideoID,
        //     'SubjectID' => $this->SubjectID,
        //     'VideoTitle' => $this->VideoTitle,
        //     'VideoURL' => $this->VideoURL,
        //     'Thumbnail' => $this->Thumbnail,
        //     'ChannelName' => $this->ChannelName,
        //     'VideoCode'=>$this->VideoCode,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        //     'subjects' => new SubjectResource($this->whenLoaded('subjects')),    
            
        // ];
         return [
            'VideoID' => $this->VideoID,
            'SubjectID' => $this->SubjectID,
            'VideoTitle' => $this->VideoTitle,
            'VideoURL' => $this->VideoURL,
            'Thumbnail' => $this->Thumbnail,
            'ChannelName' => $this->ChannelName,
            'VideoCode'=>$this->VideoCode,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
        ];
        
    }
}
