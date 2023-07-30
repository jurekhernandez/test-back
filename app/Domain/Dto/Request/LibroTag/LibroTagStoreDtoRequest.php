<?php
namespace App\Domain\Dto\Request\LibroTag;
use App\Http\Requests\LibroTag\StoreRequest;

class LibroTagStoreDtoRequest
{
    public function __construct(
        public readonly int $id_libro,
        public readonly int $id_tag,
        public readonly int $id_creador,
    ){}
    public static function fromApiRequest(StoreRequest $storeRequest):LibroTagStoreDtoRequest
    {
        return new self(
            id_libro: $storeRequest->validated(key: 'id_libro'),
            id_tag: $storeRequest->validated(key: 'id_tag'),
            id_creador: $storeRequest->user()->id,
        );
    }
}
