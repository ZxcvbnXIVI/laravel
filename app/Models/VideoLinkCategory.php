<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLinkCategory extends Model
{
    use HasFactory;

    protected $table = 'videolinkcategory'; // ระบุชื่อตาราง
    protected $primaryKey = 'id'; // ระบุ primary key ของตาราง

    protected $fillable = [
        'VideoID',
        'CategoryID',
    ];

    // สร้างความสัมพันธ์กับตาราง Video
    public function video()
    {
        return $this->belongsTo(Video::class, 'VideoID', 'VideoID');
    }

    // สร้างความสัมพันธ์กับตาราง Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID', 'CategoryID');
    }
}
