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

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'VideoID');
    }
}
