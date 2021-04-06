<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class EditFormRequest extends FormRequest
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
        $rules = [
            'email' => 'required|email|unique:users,email,'.$this->id,
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'gender' => 'required|in:Male,Female',
            'dob' => 'nullable',
            'address' => 'nullable|string',
            'contact' => 'nullable|min:10|max:15',
            'status' => 'required|in:0,1',
            'roles' => 'required|exists:roles,id',
            'image' => 'image',
        ];

        if($this->request->get('password')) {
            $rules = array_merge($rules, [
                'password' => 'min:8|confirmed',
            ]);
        }
        return $rules;
    }
}
