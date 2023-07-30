<?php

namespace App\Domain\Dto\Request\Tag;

use App\Http\Requests\Tag\UpdateRequest;

class TagUpdateDtoRequest
{
    public function __construct(
        public readonly string|null $nombre,
        public readonly int $id_modificador,
    ){}
    public static function fromApiRequest(UpdateRequest $request):TagUpdateDtoRequest
    {
        return new self(
            nombre: $request->get(key: 'nombre'),
            id_modificador: $request->user()->id,
        );
    }
}

