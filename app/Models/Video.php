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
    public function progress()
    {
        return $this->hasMany(Progress::class, 'VideoID');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'videolinkcategory', 'VideoID', 'CategoryID');
    }


    
}
