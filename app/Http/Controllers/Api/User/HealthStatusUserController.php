<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Health_status_user;


class HealthStatusUserController extends Controller
{
    use GeneralTrait;


    public function addHealthStatus(Request $request){
        $user = auth()->user();
        if($user){
            foreach ($request->health_status as $health_status_id) {
                $Health_status_user = new Health_status_user();
                $Health_status_user->user_id = $user->id;
                $Health_status_user->health_status_id = $health_status_id;
                $Health_status_user->save();
            }
            return $this->returnSuccessMessage('تمت الاضافة بنجاح');
        }else{
            return $this->returnError('','some thing went wrongs');
        }
    }






    public function index(){}

    public function create(){}

    public function show($calory){}

    public function edit($id){}

    public function destroy($id){}

}

