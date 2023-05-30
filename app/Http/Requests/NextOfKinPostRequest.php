<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NextOfKinPostRequest extends FormRequest
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
            "kins"    => "required|array|min:1|max:3",
            "kins.*.name"  => "string|required",
            "kins.*.email"  => "required|email",
            "kins.*.phone"  => "required|string",
            "kins.*.relation"  => "required|string",
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
            "kins.required" => "Please provide at least one next of kin",
            "kins.*.name.required"  => "Name field is required",
            "kins.*.name.string"  => "Name must be a string",
            "kins.*.email.required"  => "Email field is required",
            "kins.*.email.email"  => "Email must be a valid email address",
            "kins.*.phone.required"  => "Phone field is required",
            "kins.*.phone.string"  => "Phone must be a string",
            "kins.*.relation.required"  => "Relation field is required",
        ];
    }
}
