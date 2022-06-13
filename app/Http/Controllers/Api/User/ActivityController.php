<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Activity_User;
use App\Traits\GeneralTrait;

class ActivityController extends Controller
{
    use GeneralTrait;

    public function store(Request $request){
        $activity= new Activity;
        $activity->activity_name = $request->activity_name;
        $activity->description = $request->description;
        $activity->activity_factor = $request->activity_factor;
        $activity->save();
    return  $this->returnSuccessMessage("Activity has been added sucessfully");
    }


    public function update (Request $request,$activity_id){

        $activity = Activity::find($activity_id);
        if(!$activity)
            return  $this->returnError("","some thing went wrongs");
        $activity->update($request -> all());
        return $this->returnSuccessMessage('Activity updated successfully');
    }

    public function addActivityUser(Request $request){
        $user = auth()->user();
        if($user){
            $Activity= new Activity_User;
            $Activity->user_id = $user->id;
            $Activity->activity_id = $request->activity_id;
            $Activity->save();
        return  $this->returnSuccessMessage("Activity user has been added sucessfully");
        }else
            return  $this->returnError("","some thing went wrongs");
    }


    public function getAllActivities(){
        $activities=Activity::all();
        return $this -> returnData('activities',$activities);
    }


    public function getCurrentActivityUser($user_id){
        return Activity_User::where('user_id',$user_id)->get()->last()->activity_id;
    }
}
