<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Unliked_food  extends Model
{
    protected $table = 'unliked_food';
    protected $fillable = [
        'user_id ',
        'food_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    use HasFactory;



    ##################################################### Begin RelationShip #####################################################

    // public function user(){
    //     return $this->belongsTo(User::class,'user_id');
    // }
###################################################### End RelationShip #######################################################
}

