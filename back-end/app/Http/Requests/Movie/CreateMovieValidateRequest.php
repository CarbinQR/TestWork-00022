<?php

declare(strict_types=1);

namespace App\Http\Requests\Movie;

use App\Http\Requests\ApiFormRequest;

final class CreateMovieValidateRequest extends ApiFormRequest
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
