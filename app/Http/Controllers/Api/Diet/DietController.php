<?php

namespace App\Http\Controllers\Api\Diet;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Weight;
use App\Models\Diet;
use App\Models\Goal;
use App\Models\Meal;
use App\Models\User;
use App\Models\Goal_User;
use App\Models\Alternatives;
use App\Models\Meals_food;
use App\Models\Unliked_food;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;
use App\Models\Activity_User;
use App\Models\Food;
use App\Models\UserDiet;

class DietController extends Controller
{
    use GeneralTrait;
    public function index(){}
    public function create(){}
    public function edit($id){}
    public function update(Request $request, $id){}


    public function store(Request $request)
    {
        // if(Gate::allows('admin-only',auth()->user())){
        $response = Gate::inspect('admin-only');
        if ($response->allowed()) {
            $diet = new Diet;
            $diet->calory = $request->calory;
            $diet->model_number = $request->model_number;
            $diet->protien = $request->protien;
            $diet->carbohydrate = $request->carbohydrate;
            $diet->fats = $request->fats;
            $diet->save();
            foreach($request->meals as $meal){
                $m  = new Meal;
                $m->type = $meal['type'];
                $m->diet_id = $diet->id;
                $m->save();
                foreach($meal['foods'] as $food){
                    $meal_food = new Meals_food;
                    $meal_food->meal_id = $m->id;
                    $meal_food->food_id= $food['id'];
                    $meal_food->count= $food['count'];
                    $meal_food->weight= $food['weight'];
                    $meal_food->unit= $food['unit'] ;
                    $meal_food->quantity_str= $food['quantity_str'] ;
                    $meal_food->save();
                }
            }
            return $this->returnSuccessMessage("تم");
        }else{
            return $this->returnError('E044',$response->message());
        }
    }



    public function show($calory)
    {
        $diets = Diet::with('meals')->where('calory',$calory)->get();
        foreach($diets as $diet)
        {
            foreach($diet->meals as $meal)
            {
                $foods = $meal->foods;
                $meal -> foods = $foods;
            }
        }



        return $this->returnData('diets',$diets);
    }

// public function getDiet($diet_id){}



    public function destroy($diet_id)
    {
        // if(Gate::allows('admin-only',auth()->user())){
            $response = Gate::inspect('admin-only');
            if ($response->allowed()) {
            $diet = Diet::find($diet_id);
                if($diet)
                {
                    foreach($diet->meals as $meal)
                    {
                        $foods = $meal->foods()->detach();
                        $meal->delete();
                    }
                    $diet->delete();
                    return $this->returnSuccessMessage('The diet has been successfully deleted');
                }else{
                    return $this->returnError('EDd1','some thing went wrongs');
                }
        }else{
            return $this->returnError('EDd2',$response->message());
        }

    }

    public function getAllDiet()
    {
        $response = Gate::inspect('admin-only');
        if ($response->allowed())
        {
            $diets = Diet::all();
            foreach($diets as $diet){
                foreach($diet->meals as $meal){
                    $foods = $meal->foods;
                    $meal -> foods = $foods;
                }
            }
            return $this->returnData('diets',$diets);
        }else{
            return $this->returnError('EDg1',$response->message());
        }
    }

    public function getDietNewUser()
    {
        $user = auth()->user();
        $activity_id= Activity_User::where('user_id',$user->id)->get()->last()->activity_id;
        $goal_id =  Goal_User::where('user_id',$user->id)->get()->last()->goal_id;
        $weight = Weight::where('user_id',$user->id)->get()->last()->weight;
        $activity_factor = Activity::find($activity_id)->activity_factor;
        $age = Carbon::parse($user->birth_date)->age;
        $TEE =  $this->TEE($weight,$user->height,$age,$user->gender, $activity_factor);
        $calory = $this -> getCalory($TEE,$goal_id);
        $diets = Diet::with('meals') -> where('calory', $calory)->get();
        $diets_collection = collect();
        foreach ($diets as $diet) {
            $diets_collection -> push($this -> filterDiet($diet, $user));
        }
        $diets_collection =  $diets_collection->sortByDesc('level_importance')->values();
        return $this->returnData('diets',$diets_collection);
    }

    public function getDietActiveUser()
    {
        $user = auth()->user();
        $user_diet_expire = UserDiet::where('user_id',$user -> id) -> where('active',1) ->get();
        if ($user_diet_expire -> count() > 0){
            $diet =  Diet::with('meals')->find($user_diet_expire[0] -> diet_id);
            return $this -> returnData('diets', $this-> filterDiet($diet, $user));
        }else{
            return $this -> returnError('E000',"not found user diet active");
        }
    }


    public function filterDiet($diet, $user)
    {
        $array_Unliked_foods = Unliked_food::select('food_id')->where('user_id',$user->id)->get();
            $level_importance = 0;
            foreach($diet->meals as $meal)
            {
                $meals =  $meal->foods;
                for ($i=0; $i < count($meals); $i++) {
                    foreach ($array_Unliked_foods as  $value) {
                            if($meals[$i]->id === $value->food_id){
                                $alternative =  $this->getAlternatives($meals[$i]->quantity->id)->get(0);
                                if( $alternative != null ){
                                    $meals[$i] =  $alternative;
                                }else{
                                    $level_importance--;
                                }
                            }
                    }
                }
            }
            $diet['level_importance'] = $level_importance;
        return $diet;
    }




    public function saveDietUser(Request $request)
    {
        $user = auth()->user();
        if(Diet::find($request -> diet_id)){
            $user_diet = new UserDiet();
            $user_diet -> user_id = $user -> id;
            $user_diet -> diet_id = $request -> diet_id;
            $user_diet -> save();
            return $this -> returnSuccessMessage('تم الحفظ بنجاح');
        }else{
            return $this -> returnError("","some thing went wrongs");
        }
    }

    public function getAlternatives($id){
        $food = Food::with(['alternatives' => fn($query) => $query->where('meal_food_id',$id)])->get();
            if($food){
                $array = collect();
                foreach ($food  as  $value) {
                    if(count($value -> alternatives) !== 0){
                        $value['quantity'] =  $value -> alternatives ->get(0);
                        $array->push($value->makeHidden('alternatives'));
                    }
                }
            }
        return $array;
    }


    public function TEE($weight, $height, $age,$gender, $activity_factor){
        $s = ($gender === "male") ?  5 : -161;
        $BMR = (10 * $weight + 6.25 * $height - 5 * $age + $s);
        $TEE = $BMR * $activity_factor;
        return $TEE;
    }

    public function getCalory($TEE,$goal_id){
        $number  = intval($TEE /  100);
        $calory = (($number % 2 == 0) ? $number + 1 : $number) * 100;
        return $calory += Goal::find($goal_id)->goal_factor;
    }



}

