<?php
namespace App\Domain\Dto\Request\Tag;
use App\Http\Requests\Tag\StoreRequest;

class TagStoreDtoRequest
{
    public function __construct(
        public readonly string $nombre,
        public readonly int $id_creador,
    ){}
    public static function fromApiRequest(StoreRequest $storeRequest):TagStoreDtoRequest
    {
        return new self(
            nombre: $storeRequest->validated(key: 'nombre'),
            id_creador: $storeRequest->user()->id,
        );
    }
}
