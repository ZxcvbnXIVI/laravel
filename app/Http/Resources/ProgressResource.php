<?php

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
            'EnrollmentId' => $this->EnrollmentId,
            'ProgressPercentage' => $this->ProgressPercentage,
            'lastViewedTimestamp' => $this->lastViewedTimestamp,
            'users' => new UserResource($this->whenLoaded('users')),
            'videos' => new VideoResource($this->whenLoaded('videos')),
            'enrollments' => new EnrollmentResource($this->whenLoaded('enrollments')),
        ];
    }
}

