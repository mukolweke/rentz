<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => '',
            'email' => 'required|email',
            'role' => 'required',
            'occupation' => 'required_if:role,tenant',
            'house' => 'required_if:role,staff',
            'staffRole' => 'required_if:role,staff',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'occupation.required_if' => 'The occupation field is required',
            'house.required_if' => 'The house field is required',
            'staffRole.required_if' => 'The staff role field is required',
        ];
    }
}
