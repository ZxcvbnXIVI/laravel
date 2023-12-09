<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites'; // Set the table name if it's different from the model name
    protected $primaryKey = 'id'; // Specify the primary key if it's different

    protected $fillable = [
        // Define the fillable fields
        'user_id',
        'video_id',
        
    ];

    // Relationships or other model methods can be added here
}