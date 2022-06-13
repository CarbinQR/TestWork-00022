<?php

namespace App\Http\Requests\Movie;

use App\Http\Requests\ApiFormRequest;

class CreateMovieValidateRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|required|min:2|max:200',
            'description' => 'nullable|string|min:2|max:1000',
            'releaseDate' => 'required|date',
            'isLiked' => 'required|boolean',
        ];
    }
}
