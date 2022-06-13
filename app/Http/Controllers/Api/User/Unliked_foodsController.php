<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Weight;
use App\Models\Unliked_food;


class Unliked_foodsController extends Controller
{
    use GeneralTrait;
    public function index(){}

    public function create(){}

    public function store(Request $request){}

    public function show($calory){}

    public function edit($id){}

    public function update(Request $request, $id){

    }

    public function destroy($id){}

    public function addUnlikedFood(Request $request){
        $user = auth()->user();
        if($user){
            foreach ($request->unliked_food as $food_id) {
                $unliked_food = new Unliked_food();
                $unliked_food->user_id = $user->id;
                $unliked_food->food_id = $food_id;
                $unliked_food->save();
            }
            return $this->returnSuccessMessage('تمت الاضافة بنجاح');
        }else{
            return $this->returnError('','some thing went wrongs');
        }
    }

    public function getAllUnlikedFood_User(){
        $user = auth()->user();
        $unlikedFoods =  $user->unliked_foods->makeHidden('pivot');
        return $this->returnData('unliked_Foods',$unlikedFoods);
    }



}

