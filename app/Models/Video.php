<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos'; 
    protected $primaryKey = 'VideoID'; 
    protected $fillable = [
        'SubjectID',
        'CategoryID',
        'VideoTitle',
        'VideoURL',
        'Thumbnail',
        'ChannelName',
    ];

    public $timestamps = true;

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }
}
