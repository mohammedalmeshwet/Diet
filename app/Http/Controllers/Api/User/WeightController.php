<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Weight;


class WeightController extends Controller
{
    use GeneralTrait;
    public function index(){}

    public function create(){}

    public function store(Request $request){}

    public function show($calory){}

    public function edit($id){}

    public function update(Request $request, $id){}

    public function destroy($id){}

    public function addWeightUser(Request $request){
        $user = auth()->user();
        if($user){
            $wieght = new Weight();
            $wieght->user_id = $user->id;
            $wieght->weight = $request->weight;
            $wieght->save();
            return $this->returnSuccessMessage('تمت الاضافة بنجاح');
        }else{
            return $this->returnError('','some thing went wrongs');
        }
    }

    public function getCurrentWeightUser($user_id){
        return Weight::where('user_id',$user_id)->get()->last()->weight;
    }




}

