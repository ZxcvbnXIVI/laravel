<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        // Define the fillable fields
        'user_id',
        'video_id',
    ];

    // Relationships or other model methods can be added here
}
