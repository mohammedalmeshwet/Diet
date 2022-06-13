<?php

namespace App\Http\Controllers\Api\Exercise;

use App\Http\Controllers\Controller;
use App\Models\TrainingExercises;
use App\Models\UserExercise;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;



class TrainingExercisesController extends Controller
{
    use GeneralTrait;
    public function index(){}

    public function create(){}

    public function store(Request $request){}

    public function show($calory){}

    public function edit($id){}

    public function update(Request $request, $id){}

    public function destroy($id){}


    public function addTrainingExercise(Request $request){
        $training_exercise  = new TrainingExercises();
        $training_exercise -> activity_id =  $request -> activity_id;
        $training_exercise -> name = $request -> name;
        $training_exercise -> days_count = $request -> days_count;
        $training_exercise -> save();
        return $this->returnSuccessMessage('Training Exercise has been added sucessfully');
    }

    public function getAllTrainingExercise(){
        $training_exercises = TrainingExercises::with('activity')->with('days')->get()->makeHidden(['activity_id']);
        foreach ($training_exercises as $training_exercise_day) {
            foreach ($training_exercise_day -> days as $day){
                $day['training_exercise_day_id'] = $day -> pivot -> id;
                $day -> makeHidden(['pivot']);
            }
        }
        return $this->returnData('training_exercises', $training_exercises);
    }
    public function getAllUserTrainingExercise(){
        $training_exercises = TrainingExercises::all()->makeHidden(['activity_id']);
        return $this->returnData('training_exercises', $training_exercises);
    }

    public function getUserTrainingExercises(){
        $user = auth()->user();
        $training_exercise_id = (new UserExerciseController()) -> getCurrentTrainingExerciseUser($user -> id);
        $training_exercises = TrainingExercises::with('activity')->with('days')->find($training_exercise_id)->makeHidden(['activity_id']);
            foreach ($training_exercises -> days as $day){
                $day['training_exercise_day_id'] = $day -> pivot -> id;
                $day -> makeHidden(['pivot']);
            }

        return $this->returnData('training_exercises', $training_exercises);
    }






}

