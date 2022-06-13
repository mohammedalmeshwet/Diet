<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Meals_food  extends Authenticatable implements JWTSubject
{
    protected $table = 'meals_food';

    protected $fillable = [
        'meal_id',
        'food_id',
        'count',
        'weight',
        'unit',
        'quantity_str',
        'is_basic'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];


        ################################################# Begin RelationShip #####################################################
        // public function meal(){
        //     return $this->belongsTo(Meal::class,'meal_id');
        // }
        public function Alternatives(){
            return $this->hasMany(Alternatives::class,'meal_food_id');
        }
        public function foods(){
            return $this->belongsTo(Food::class,'food_id');
        }


        public function alternatives_foods(){
            return $this->belongsToMany(food::class,'alternatives','meal_food_id','food_id')->as('quantity')->withPivot('id','count','weight', 'unit', 'quantity_str','is_basic');
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
