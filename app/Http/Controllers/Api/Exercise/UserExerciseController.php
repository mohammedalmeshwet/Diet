<?php

namespace App\Http\Controllers\Api\Exercise;

use App\Http\Controllers\Controller;
use App\Models\TrainingExercises;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\UserExercise;
use App\Traits\ExerciseTrait;

class UserExerciseController extends Controller
{
    use GeneralTrait;
    use ExerciseTrait;

    public function saveUserExercise(Request $request){
        $user = auth()->user();
        if(TrainingExercises::find($request -> training_exercise_id)){
            $user_exercise = new UserExercise();
            $user_exercise -> user_id = $user -> id;
            $user_exercise -> trainning_exercises_id = $request -> training_exercise_id;
            $user_exercise -> save();
            return $this -> returnSuccessMessage('تم الحفظ بنجاح');
        }else{
            return $this -> returnError("","some thing went wrongs");
        }
    }


    public function getCurrentTrainingExerciseUser($user_id){
        return UserExercise::where('user_id',$user_id)->get()->last()->trainning_exercises_id;
    }


}

