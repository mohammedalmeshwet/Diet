<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Meals_food;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Alternatives;
use App\Models\Food;

class AlternativesController extends Controller
{
    use GeneralTrait;
    public function index(){}

    public function create(){}

    public function store(Request $request){}

    public function show($calory){}

    public function edit($id){}

    public function update(Request $request, $id){}

    public function destroy($id){}


    public function getAlternativesToMeal(Request $request)
    {

        $allAlternativesToMeal = array();
        foreach($request->foods as $food)
        {
            $coll = array();
            $meal_food_id = ((object)$food['quantity'])->id;

            if(Meals_food::find($meal_food_id)->food_id == $food['id'])
            {
                $alternatives_foods_array = Meals_food::with('alternatives_foods')->where('id',$meal_food_id)->get();
                if(!empty($alternatives_foods_array[0]->alternatives_foods->all())){

                    $coll['main_food'] = $food;
                    $coll['alternatives'] = $alternatives_foods_array[0]->alternatives_foods;
                }
            }else {
                $alternatives_id = ((object)$food['quantity'])->id;
                $meal_food_id = ((object)$food['quantity'])->meal_food_id;

                // return $alternatives_foods = Food::with('alternatives')->whereHas('alternatives',function($query) use ($meal_food_id ){
                //     // return $meal_food_id;
                //    $query->where('meal_food_id',108);
                // })->get();


                  // $alternatives_foods = Food::with('alternatives',)->get();

            $alternatives_foods_array = Meals_food::with('alternatives_foods')->where('id',$meal_food_id)->get();


                foreach($alternatives_foods_array as $alternatives_food){


                     //return $alternatives_food;
                     $alternatives_foods = $alternatives_food->alternatives_foods;

// return $alternatives_foods;


                    foreach ($alternatives_foods as $key => $value) {


                        if($food['id'] == $value->id) {


                            unset($alternatives_foods[$key]);
                        }
                    }



// return $alternatives_foods;

                    if(!empty($alternatives_foods->all()))
                    {
$coll['main_food'] = $food;
                            $coll['alternatives'] = array_values($alternatives_foods->all());

                    }
                }
            }
            if(!empty($coll))
                array_push($allAlternativesToMeal,$coll);
        }
        return $this->returnData('alternative_meal',$allAlternativesToMeal);
    }



}

