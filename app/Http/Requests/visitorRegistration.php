<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class visitorRegistration extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName'=> 'required',
            'secondName'=> 'required',
            'idNumber'=> 'required|integer',
            'typeOfVisitor'=> 'required',
            'company'=>'required',
            'visitorImage'=> 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
            'address'=>'required'
        ];
    }
}
