<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Activity_User extends Authenticatable implements JWTSubject
{
    protected $table = 'activity_user';

    protected $fillable = [
        'user_id ',
        'activity_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    ################################################# Begin RelationShip #####################################################


    // public function users(){
    //     return $this->belongsToMany(User::class,'meals_food','meal_id','food_id')->as('quantity')->withPivot('count','weight', 'unit', 'quantity_str');
    // }
###################################################### End RelationShip #######################################################
    use HasFactory;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
