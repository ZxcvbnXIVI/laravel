<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'SubjectID' => $this->SubjectID,
            'SubjectName' => $this->SubjectName,
            'Description' => $this->Description,
            'PlaylistLink' => $this->PlaylistLink,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
