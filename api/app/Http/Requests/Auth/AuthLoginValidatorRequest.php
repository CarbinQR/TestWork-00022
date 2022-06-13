<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;
use App\Rules\EmailRfcValidationRule;

final class AuthLoginValidatorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'password' => 'required|min:3|max:60',
            'email' => [
                'required',
                'exists:users,email',
                'min:3',
                'max:100',
                new EmailRfcValidationRule()
            ]
        ];
    }
}
