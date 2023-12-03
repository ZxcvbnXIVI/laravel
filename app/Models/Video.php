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
        // 'CategoryID',
        'VideoTitle',
        'VideoURL',
        'Thumbnail',
        'VideoCode',
        'ChannelName',
    ];

    public $timestamps = true;
    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'SubjectID', 'SubjectID');
    }
    // public function subjects()
    // {
    //     return $this->belongsTo(Subject::class, 'SubjectID');
    // }

    
    public function progress()
    {
        return $this->hasMany(Progress::class, 'VideoID');
    }
    
}
