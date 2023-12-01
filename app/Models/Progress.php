<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';
    protected $primaryKey = 'ProgressID';
    protected $fillable = [
        'UserID',
        'VideoID',
        'EnrollmentId',
        'ProgressPercentage',
        'lastViewedTimestamp',
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

    public function enrollments()
    {
        return $this->belongsTo(Enrollment::class, 'EnrollmentId');
    }
}
