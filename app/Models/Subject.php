<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = ['name', 'category', 'image'];
    protected $attributes = [
        'image' => 'default.jpg',
    ];


    use HasFactory;
}

