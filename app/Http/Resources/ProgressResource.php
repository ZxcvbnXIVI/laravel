<?php

// app/Http/Resources/ProgressResource.php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgressResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'ProgressID' => $this->ProgressID,
            'UserID' => $this->UserID,
            'VideoID' => $this->VideoID,
            'ProgressPercentage' => $this->ProgressPercentage,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
