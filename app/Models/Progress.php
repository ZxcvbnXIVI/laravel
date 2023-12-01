<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';
    protected $primaryKey = 'ProgressID';
    protected $fillable = [
        'UserID',
        'VideoID',
        'ProgressPercentage',
    ];

    public $timestamps = true;

    public function users()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function videos()
    {
        return $this->belongsTo(Video::class, 'VideoID');
    }
}
