<?php

declare(strict_types=1);

namespace App\Http\Requests\Movie;

use App\Http\Requests\ApiFormRequest;

final class ExistMovieValidateRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:movies,id',
        ];
    }
}
