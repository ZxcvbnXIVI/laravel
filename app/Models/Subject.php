<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects'; // ระบุชื่อตาราง
    protected $primaryKey = 'SubjectID';

    protected $fillable = [
        'SubjectName',
        'Description',
        'PlaylistLink',
    ];
    public $timestamps = true;
    public function videos()
    {
        return $this->hasMany(Video::class, 'SubjectID', 'SubjectID')->with('categories');
    }

    public function Enrollments() {
        return $this->hasMany(Enrollment::class);
    }


}