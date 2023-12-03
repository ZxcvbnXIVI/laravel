<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    
    public function toArray($request)
{
    return [
        'CategoryID' => $this->CategoryID,
        'CategoryName' => $this->CategoryName,
        'CategoryImage' => $this->CategoryImage,
        'created_at' => $this->created_at->toDateTimeString(),
        'updated_at' => $this->updated_at->toDateTimeString(),
        'deleted_at' => $this->deleted_at,
    ];
}
}
