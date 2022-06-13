<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;
use App\Rules\EmailRfcValidationRule;

final class AuthSignUpValidatorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'login' => 'required|min:3|unique:users',
            'password' => 'min:3|max:60',
            'password_confirmation' => 'required_with:password|same:password|min:3|max:60',
            'email' => [
                'required',
                'unique:users',
                'min:3',
                'max:100',
                new EmailRfcValidationRule()
            ]
        ];
    }
}
