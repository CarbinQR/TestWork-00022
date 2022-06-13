<?php

namespace App\Http\Requests\Movie;

use App\Http\Requests\ApiFormRequest;

class UpdateMovieValidateRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:200',
            'description' => 'nullable|string|min:2|max:1000',
            'releaseDate' => 'required|date',
            'isLiked' => 'required|boolean',
        ];
    }
}
