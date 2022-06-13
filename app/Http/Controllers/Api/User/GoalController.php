<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal_User;
use App\Models\Weight;
use App\Models\Goal;
use App\Traits\GeneralTrait;
use App\Traits\Rules;

class GoalController extends Controller
{
    use GeneralTrait;
    use Rules;


    public function store(Request $request){
        $goal= new Goal;
        $goal->goal_name = $request->goal_name;
        $goal->goal_factor = $request->goal_factor;
        $goal->save();
    return  $this->returnSuccessMessage("goal has been added sucessfully");

}


    public function setGoalUser(Request $request){
        $user = auth()->user();
        if($user){
            $goal= new Goal_User;
            $goal->user_id = $user->id;
            $goal->goal_id = $request->goal_id;
            $goal->save();
        return  $this->returnSuccessMessage("goal has been added sucessfully");
        }else
            return  $this->returnError("","some thing went wrongs");
    }


    public function getCurrentGoalUser($user_id){
        return Goal_User::where('user_id',$user_id)->get()->last()->goal_id;
    }

    public function getAllUserGoal(){
        $goals=Goal::all();
        $goals = $goals->push((object)['id' => 0, 'goal_name' => $this->getSystemDecisionToGoal()]);
        return $this -> returnData('goals',$goals);
    }

    public function getAllGoal(){
        $goals=Goal::all();
        return $this -> returnData('goals',$goals);
    }

    public function getSystemDecisionToGoal(){
        $user = auth()->user();
        $user_weight = Weight::where('user_id',$user->id)->get()->last()->weight;
        $perfect_weight = $this->perfectWeight($user->gender,$user->height);
        $diff_weight =  $perfect_weight - $user_weight;
        if($diff_weight >= -4 && $diff_weight <= 4) {
            return 'الحفاظ على الوزن';
        }else if ($diff_weight > 0 ){
            return 'زيادة الوزن';
        }else if($diff_weight < 0){
            return 'نقصان الوزن';
        }
    }


}
