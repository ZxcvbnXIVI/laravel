<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'CategoryID';
    protected $fillable = [
        'CategoryName',
        'CategoryImage'
    ];

    public $timestamps = true;
    public function subjects()
    {
        return $this->hasMany(Subject::class, 'CategoryID', 'CategoryID');
    }
}


