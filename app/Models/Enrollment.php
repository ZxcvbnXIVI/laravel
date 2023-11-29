<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'enrollments'; // ชื่อตารางในฐานข้อมูล
    protected $primaryKey = 'EnrollmentID'; // Primary key ของตาราง
    protected $fillable = [
        'UserID',
        'SubjectID',
        'EnrollmentDate',
    ];

    public $timestamps = true; // ถ้าคุณใช้ timestamps สามารถเปลี่ยนเป็น false ได้

    // Define the relationships with User and Subject models
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID');
    }
}

