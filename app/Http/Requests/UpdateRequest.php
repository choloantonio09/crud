<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'id' => 'required',
            'name' => 'bail|required|regex:/^\pL[\pL \'-]*\z/|max:255',
            'email' => 'bail|required|email|max:255',
        ];
    }

    public function messages()
    {
        return [

            'name.regex' => 'Only letters, " - " and " \' " are allowed in NAME.',

            'name.required' => '<br> Your NAME is required.',
            'email.required'  => '<br> Your EMAIL is required.',
            
            'name.max' => '<br> NAME must be less than 255 characters.',
            'email.max' => '<br> EMAIL must be less than 255 characters.',
        
            'email.email' => '<br> Please enter a valid EMAIL format.'

        ];
    }
}
