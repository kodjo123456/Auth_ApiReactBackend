<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:64|min:4|unique:users",
            "email" => "required|email|max:150|min:4|unique:users",
            "password" => "required|string|min:8",
            "passwordConfirm" => "required|same:password",
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Name est requis',
            'name.min' => 'Le nom doit contenir au moins 3 characters',
            'name.max' => 'Le nom doit contenir au plus 255 characters',
            'email.required' => 'Email est requise',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'passwordComfirm.same' => 'Password confirm is failed',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Echec de validation.',
            'data'      => $validator->errors()
        ]));
    }
}
