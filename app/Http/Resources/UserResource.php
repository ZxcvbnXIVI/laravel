<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'UserID' => $this->UserID,
            'UserName' => $this->UserName,
            'UserType' => $this->UserType,
            'EnrollmentDate' => $this->EnrollmentDate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
