<?php

namespace App\Http\Requests\Movie;

use App\Http\Requests\ApiFormRequest;

class DeleteMovieValidateRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:movies,id'
        ];
    }
}
