<?php

namespace App\Domain\Dto\Request\LibroTag;

use App\Http\Requests\LibroTag\UpdateRequest;

class LibroTagUpdateDtoRequest
{
    public function __construct(
        public readonly string|null $property,
        public readonly int $id_modificador,
    ){}
    public static function fromApiRequest(UpdateRequest $request):LibroTagUpdateDtoRequest
    {
        return new self(
            property: $request->get(key: 'nombre'),
            id_modificador: $request->user()->id,
        );
    }
}

