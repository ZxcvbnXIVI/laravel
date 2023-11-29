<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'EnrollmentID' => $this->EnrollmentID,
            'UserID' => $this->UserID,
            'SubjectID' => $this->SubjectID,
            'EnrollmentDate' => $this->EnrollmentDate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
