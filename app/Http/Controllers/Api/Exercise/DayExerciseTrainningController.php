<?php

namespace App\Http\Controllers\Api\Exercise;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\DayExerciseTrainning;
use App\Traits\ExerciseTrait;
use App\Models\TrainExerDayExercises;

class DayExerciseTrainningController extends Controller
{
    use GeneralTrait;
    use ExerciseTrait;

    public function addTrainningExerciseDay(Request $request){
        foreach ($request -> days as $day) {
            $day_exercise_trainning  = new DayExerciseTrainning();
            $day_exercise_trainning -> trainning_exercise_id = $request -> trainning_exercise_id;
            $day_exercise_trainning -> day_id = $day['id'];
            $day_exercise_trainning -> save();
            foreach ($day['exercises'] as $exercise) {
                $train_exer_day_exercises  = new TrainExerDayExercises();
                $train_exer_day_exercises -> trainning_exercise_day_id = $day_exercise_trainning -> id;
                $train_exer_day_exercises -> exercise_id = $exercise['exercise_id'];
                $train_exer_day_exercises -> save();
            }
        }

        return $this->returnSuccessMessage('Day Exercise Trainning has been added sucessfully');
    }

    public function getAllTrainningExerciseDay(){
        $day_exercise_trainning =  (new DayExerciseTrainning()) -> all();
        return $this->returnData('day_exercise_trainning', $day_exercise_trainning);
    }

    public function getDaySpecificExercises($id){
        $trainning_exercise_day = DayExerciseTrainning::with('exercises')->where('id',$id)->get();
        return $this->returnData('trainning_exercise_day', $trainning_exercise_day);
    }
}

