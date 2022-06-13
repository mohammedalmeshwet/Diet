<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal_User extends Model
{
    protected $table="goal_user";
    protected $fillable=[
        "user_id",
        "goal_id"
    ];
    use HasFactory;
    
}
