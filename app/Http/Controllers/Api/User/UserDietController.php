<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDiet;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Weight;


class UserDietController extends Controller
{
    use GeneralTrait;
    public function index(){}

    public function create(){}

    public function store(Request $request){}

    public function show($calory){}

    public function edit($id){}

    public function update(Request $request, $id){}

    public function destroy($id){}

    public function checkUserHaveDietActive(){
        $user = auth()->user();
        $user_diet = UserDiet::where('user_id',$user -> id) -> get();
        if($user_diet -> count() != 0){
            $status = ($user_diet->contains('active', 1) ? 1 : 0);

        }else{
            $status = 2;
        }
        return $this->returnData('user_have_diet_active', $status );
    }

    public function getCurrentDietUser($user_id){
        return UserDiet::where('user_id',$user_id)->get()->last()->diet_id;
    }




}

