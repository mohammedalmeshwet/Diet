<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExercise extends Model
{
    protected $table="user_exercise";
    protected $fillable=[
        "user_id",
        "trainning_exercises_id",
        "place"
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    use HasFactory;

    // public function user(){
    //     return $this->belongsTo(User::class,'user_id');
    // }
}
