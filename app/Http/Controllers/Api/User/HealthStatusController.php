<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\HealthStatus;


class HealthStatusController extends Controller
{
    use GeneralTrait;
    public function index(){}

    public function create(){}

    public function store(Request $request){
        $healthStatus =  new HealthStatus();
        $healthStatus -> health_status_name = $request -> health_status_name;
        $healthStatus -> save();
        return  $this->returnSuccessMessage("health status name has been added sucessfully");
    }

    public function update(Request $request, $id)
    {
        $healthStatus = HealthStatus::find($id);
        if(!$healthStatus)
            return  $this->returnError("","some thing went wrongs");
        $healthStatus->update($request -> all());
        return $this->returnSuccessMessage('Health Status updated successfully');
    }

    public function getAllHealthStatus()
    {
        $healthStatus =  new HealthStatus();
        return $this -> returnData('healthStatus',$healthStatus->all());
    }


    public function show($calory){}

    public function edit($id){}

    public function destroy($id){}

}

