<?php

namespace App\Domain\Dto\Request\Autor;

use App\Http\Requests\Autor\UpdateRequest;

class AutorUpdateDtoRequest
{
    public function __construct(
        public readonly string|null $nombre,
        public readonly string|null $biografia,
        public readonly string|null $fecha_nacimiento,
        public readonly int $id_modificador,
    ){}
    public static function fromApiRequest(UpdateRequest $request):AutorUpdateDtoRequest
    {
        return new self(
            nombre: $request->get(key: 'nombre'),
            biografia: $request->validated(key: 'biografia'),
            fecha_nacimiento: $request->validated(key: 'fecha_nacimiento'),
            id_modificador: $request->user()->id,
        );
    }
}
