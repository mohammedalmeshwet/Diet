<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $table="goals";
    protected $fillable=[
        "user_id",
        "goal_name",
        "goal_factor"
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
