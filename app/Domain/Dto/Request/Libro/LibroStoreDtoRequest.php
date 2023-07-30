<?php
namespace App\Domain\Dto\Request\Libro;
use App\Http\Requests\Libro\StoreRequest;

class LibroStoreDtoRequest
{
    public function __construct(
        public readonly string $nombre,
        public readonly string $resumen,
        public readonly int $id_autor,
        public readonly int $id_creador,
    ){}
    public static function fromApiRequest(StoreRequest $storeRequest):LibroStoreDtoRequest
    {
        return new self(
            nombre: $storeRequest->validated(key: 'nombre'),
            resumen: $storeRequest->validated(key: 'resumen'),
            id_autor: $storeRequest->validated(key: 'id_autor'),
            id_creador: $storeRequest->user()->id,
        );
    }
}
