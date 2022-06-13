<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\User;
use App\Models\UserDietAssesement;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Weight;


class UserDietAssesementController extends Controller
{
    use GeneralTrait;
    public function store(Request $request)
    {
        $user = auth()->user();
        if($user){
            $diet_id = (new UserDietController) -> getCurrentDietUser($user->id);
            $goal_id = (new GoalController) -> getCurrentGoalUser($user->id);
            $old_weight_value = (new WeightController) -> getCurrentWeightUser($user->id);
            $new_weight_value = $request -> new_weight;
            $rank = (int) abs((($new_weight_value - $old_weight_value) / $old_weight_value ) * 100);
            $is_pass = $this->isPassDietUser($goal_id, $old_weight_value, $new_weight_value);
            $user_diet_assesement = new UserDietAssesement();
            $user_diet_assesement -> user_id = $user->id;
            $user_diet_assesement -> diet_id = $diet_id;
            $user_diet_assesement -> goal_id = $goal_id;
            $user_diet_assesement -> old_weight_value = $old_weight_value;
            $user_diet_assesement -> new_weight_value = $new_weight_value;
            $user_diet_assesement -> rank = $rank;
            $user_diet_assesement -> is_pass = $is_pass;
            $user_diet_assesement -> save();

            $wieght = new Weight();
            $wieght->user_id = $user->id;
            $wieght->weight = $request->new_weight;
            $wieght->save();

            return $this->returnData('assesement', $this -> getCurrentUserDietAssesement($user->id));
        }else{
            return $this->returnError('','some thing went wrongs');
        }
    }

    public function getCurrentUserDietAssesement($user_id){
        return UserDietAssesement::where('user_id',$user_id)->get()->last();
    }

    public function isPassDietUser($goal_id, $old_weight_value, $new_weight_value){
        $goal_factor = Goal::find($goal_id)->goal_factor;
        if($goal_factor < 0 ) {
            return ($new_weight_value - $old_weight_value < 0 ) ? 1 : 0;
        }else if ($goal_factor > 0 ) {
            return ($new_weight_value - $old_weight_value > 0 ) ? 1 : 0;
        }else{
            return ($new_weight_value - $old_weight_value = 0 ) ? 1 : 0;
        }
    }



}

