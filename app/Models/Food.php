<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Meal;

class Food  extends Authenticatable implements JWTSubject
{
    protected $table = 'foods';

    protected $fillable = [
        'id',
        'food_name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

##################################################### Begin RelationShip #####################################################

    // public function meals_food(){
    //     return $this->hasMany(Meals_food::class,'food_id');
    // }

    public function alternatives(){
        return $this->hasMany(Alternatives::class,'food_id','id','meal_food_id');
    }


    public function meals(){
        return $this->belongsToMany(Meal::class,'meals_food','food_id','meal_id');
    }
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
