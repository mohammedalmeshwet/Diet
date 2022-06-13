<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $table="exercises";
    protected $fillable=[
        "exercise_name",
        "video_path",
        "enternal_image",
        "muscle_image",
        "description",
        "count",
        "time"
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot'
    ];


    use HasFactory;

    // public function user(){
    //     return $this->belongsTo(User::class,'user_id');
    // }
}
