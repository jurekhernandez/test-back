<?php

namespace App\Domain\Dto\Request\Autor;

use App\Http\Requests\Autor\StoreRequest;

class AutorStoreDtoRequest
{
    public function __construct(
        public readonly string $nombre,
        public readonly string $biografia,
        public readonly string $fecha_nacimiento,
        public readonly int $id_creador,
    ){}
    public static function fromApiRequest(StoreRequest $storeRequest):AutorStoreDtoRequest
    {
        return new self(
            nombre: $storeRequest->validated(key: 'nombre'),
            biografia: $storeRequest->validated(key: 'biografia'),
            fecha_nacimiento: $storeRequest->validated(key: 'fecha_nacimiento'),
            id_creador: $storeRequest->user()->id,
        );
    }
}
