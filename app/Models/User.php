<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users'; // ชื่อตารางในฐานข้อมูล
    protected $primaryKey = 'UserID'; // Primary key ของตาราง
    protected $fillable = [
        'UserName',
        'password', 
        'Role',
        'image_path',
    ];

    public $timestamps = true; 
}
