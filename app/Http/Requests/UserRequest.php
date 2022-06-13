<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           // 'email' => 'required',
        ];

    }
    // public function messages(){
    //     return [
    //         'email.required' => 'يجب ادخال الاسم'

    //         // 'price.required' => 'يجب ادخال السعر',
    //         // 'details.required' => 'يجب ادخال مواصفات العرض'
    //     ];
    // }
}
