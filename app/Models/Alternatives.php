<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatives extends Model
{
    protected $table="alternatives";
    protected $fillable=[
        'id',
        "meal_food_id",
        "food_id",
        'count',
        'weight',
        'unit',
        'quantity_str',
        'is_basic'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    use HasFactory;

    public function foods(){
        return $this->belongsTo(Food::class,'food_id');
    }

    // public function (){
    //     return $this->belongsTo(Meals_food::class,'meal_food_id ');
    // }
}
