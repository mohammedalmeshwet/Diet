<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Weight;
use App\Models\Activity;

class User extends Authenticatable implements JWTSubject
{


        protected $table = 'users';
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'birth_date',
        'gender',
        'height',
        'level'

    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }



##################################################### Begin RelationShip #####################################################

    public function weights()
    {
        return $this->hasMany(Weight::class,'user_id');
    }


      public function activities(){
        return $this->belongsToMany(Activity::class,'activity_user','user_id','activity_id')->as('activities');
    }
    // public function goals()
    // {
    //     return $this->hasMany(Goal::class,'user_id');
    // }


    public function unliked_foods(){
        return $this->belongsToMany(food::class,'unliked_food');
    }
###################################################### End RelationShip #######################################################
}
