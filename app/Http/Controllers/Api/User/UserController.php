<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Weight;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Gate;
class UserController extends Controller
{
    use GeneralTrait;

    public function Register(Request $request)
    {
        $rules = $this->getRulesRegister();
        $messages = $this->getMessagesRegister();
        $validator = Validator::make($request -> all(), $rules, $messages);
        if($validator -> fails()){
            return $this -> returnError('E000',$validator -> errors());
        }
        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $this->returnSuccessMessage('تم انشاء الحساب');
    }

    public function changeStatusUser(Request $request,$user_id)
    {
        $user =  User::find($user_id);
        if($user){
            $user->level =  $request -> level;
            $user->save();
            return $this -> returnSuccessMessage('level changed successfully');
        }else{
            return  $this->returnError("","some thing went wrongs");
        }
    }

    public function add_Personal_Information(Request $request)
    {
        $user = auth()->user();
        $response = Gate::inspect('user-only');
        if ($response->allowed()) {

            $rules = $this->getRulesInfo();
            $messages = $this->getMessagesInfo();
            $validator = Validator::make($request -> all(), $rules, $messages);
            if($validator -> fails()){
                return $this -> returnError('E000',$validator -> errors());
            }

            User::where('id',$user->id)->update([
                'first_name' => $request -> first_name,
                'last_name' => $request -> last_name,
                'birth_date' => $request -> birth_date,
                'gender' => $request -> gender,
                'height' => $request -> height,
            ]);
            $weight  = new Weight();
            $weight->user_id = $user->id;
            $weight->weight = $request->weight;
            $weight->save();
            
            $user = User::find($user->id);
        return $this->returnData('user',$user,"تم التعديل بنجاح");
        } else {
            return $this->returnError('E000',$response->message());
        }
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
            $result = $user->delete();
                if($result)
                {
                    return $this ->returnSuccessMessage('تم حذف المستخدم رقم   '.$id);
                }else{
                    return $this ->returnError("E000",'لم يتم  حذف المستخدم رقم  '.$id);
                }
        }else{
            return $this->returnError("E005","المستخدم غير موجود");
        }
    }

    public function getAllUsers()
    {
        $users =  User::all();
        return $this->returnData('users',$users);
    }

    public function getRulesInfo(){
        return [
            'first_name' => ['required','max:100'],
            'last_name' => ['required','max:100'],
            'birth_date' => ['required'],
            'gender' => ['required'],
            'height' => ['required','numeric']
        ];
    }


    public function getRulesRegister(){
        return [
            'email' => ['required','unique:users,email'],
            'password' => ['required','confirmed'],
        ];
    }

    public function getMessagesInfo(){
        return [
            'first_name.required' => 'يجب ادخال الاسم الأول',
            'last_name.required' => 'يجب ادخال الاسم الثاني',
            'birth_date.required' => 'يجب ادخال تاريخ الميلاد',
            'gender.required' => 'يجب ادخال الجنس',
            'height.required' => 'يجب ادخال الطول',
            'height.numeric' => 'يجب أن يكون الطول رقم',
        ];
    }

    public function getMessagesRegister(){
        return [
            'email.required' => 'يجب ادخال الإيميل',
            'email.unique' => 'الايميل مستخدم مسبقاً',
            'password.required' => 'يجب ادخال كلمة السر',
            'password.confirmed' => 'يجب اعاده تأكيد كلمة السر',
        ];
    }



}
