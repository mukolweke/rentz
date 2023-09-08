<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantUpdatePostRequest extends FormRequest
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
    public function rules(): array
    {
        $requestType = request()->get('type');

        if ($requestType == 'about') {
            return [
                'name' => 'required|string|min:3',
                'occupation' => 'required|string|min:3'
            ];
        } elseif ($requestType == 'contact') {
            return [
                'email' => 'required|email',
                'phone' => 'required'
            ];
        } elseif ($requestType == 'password') {
            return [
                'password' => [
                    'required',
                    'min:8',
                    'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@*$#%]).*$/',
                    'confirmed'
                ]
            ];
        }

        return [];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'password.regex' => 'Please provide a strong password with a capital letter, a small letter, numbers and at least !@*$#%',
        ];
    }
}
