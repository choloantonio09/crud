<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'bail|required|regex:/^\pL[\pL \'-]*\z/|max:255',
            'email' => 'bail|required|max:255',
            'password' => 'bail|required|max:255|min:8'
        ];
    }

    public function messages()
    {
        return [

            'name.regex' => 'Only letters, " - " and " \' " are allowed in NAME.',

            'name.required' => '<br> Your NAME is required.',
            'email.required'  => '<br> Your EMAIL is required.',
            'password.required' => '<br> A PASSWORD is required.',

            'name.max' => '<br> NAME must be less than 255 characters.',
            'email.max' => '<br> EMAIL must be less than 255 characters.',
            'password.max' => '<br> PASSWORD must be less than 255 characters.',

            'email.email' => '<br> Please enter a valid EMAIL format.',
            //'email.unique' => '<br> EMAIL already used by a different account.',

            'password.min' => '<br> PASSWORD must have at least 8 characters.'


        ];
    }
}
