<?php

namespace App\Domain\Dto\Request\Libro;

use App\Http\Requests\Libro\UpdateRequest;

class LibroUpdateDtoRequest
{
    public function __construct(
        public readonly string|null $nombre,
        public readonly string|null $resumen,
        public readonly int|null $id_autor,
        public readonly int $id_modificador,
    ){}
    public static function fromApiRequest(UpdateRequest $request):LibroUpdateDtoRequest
    {
        return new self(
            nombre: $request->get(key: 'nombre'),
            resumen: $request->get(key: 'resumen'),
            id_autor: $request->get(key: 'id_autor'),
            id_modificador: $request->user()->id,
        );
    }
}

