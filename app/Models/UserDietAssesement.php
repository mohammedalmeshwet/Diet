<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserDietAssesement  extends Model
{
    protected $table = 'user_diet_assesement';
    protected $fillable = [
        'id',
        'user_id',
        'diet_id',
        'goal_id',
        'old_weight_value',
        'new_weight_value',
        'rank',
        'is_pass'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    use HasFactory;



    ##################################################### Begin RelationShip #####################################################


###################################################### End RelationShip #######################################################
}

