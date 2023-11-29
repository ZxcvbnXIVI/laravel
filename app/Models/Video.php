<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos'; // ชื่อตารางในฐานข้อมูล
    protected $primaryKey = 'VideoID'; // Primary key ของตาราง
    protected $fillable = [
        'SubjectID',
        'CategoryID',
        'VideoTitle',
        'VideoURL',
        'Thumbnail',
        'ChannelName',
    ];

    public $timestamps = true; // ถ้าคุณใช้ timestamps สามารถเปลี่ยนเป็น false ได้

    // Define the relationships with Subject and Category models
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }
}
