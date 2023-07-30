<?php
namespace App\Domain\Dto\Request\Comentarios;
use App\Http\Requests\Comentarios\StoreRequest;

class ComentariosStoreDtoRequest
{
    public function __construct(
        public readonly string $comentario,
        public readonly int $id_libro,
        public readonly int $id_creador,
    ){}
    public static function fromApiRequest(StoreRequest $storeRequest):ComentariosStoreDtoRequest
    {
        return new self(
            comentario: $storeRequest->validated(key: 'comentario'),
            id_libro: $storeRequest->validated(key: 'id_libro'),
            id_creador: $storeRequest->user()->id,
        );
    }
}
