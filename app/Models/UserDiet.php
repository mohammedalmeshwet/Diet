<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserDiet  extends Model
{
    protected $table = 'user_diet';
    protected $fillable = [
        'user_id',
        'diet_id',
        'expire',
        'created_at'
    ];

    protected $hidden = [
        'updated_at',
    ];
    use HasFactory;



    ##################################################### Begin RelationShip #####################################################


###################################################### End RelationShip #######################################################
}

