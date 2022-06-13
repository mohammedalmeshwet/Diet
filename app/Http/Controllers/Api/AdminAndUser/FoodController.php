<?php

namespace App\Http\Controllers\Api\AdminAndUser;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    use GeneralTrait;
    public function getAllFoods(){
        $foods=Food::all();
        return $this -> returnData('foods',$foods);
    }

    public function store(Request $request){
            $food= new Food;
            $food->food_name = $request->food_name;
            $food->save();
        return  $this->returnSuccessMessage("food name has been added sucessfully");

    }
}
