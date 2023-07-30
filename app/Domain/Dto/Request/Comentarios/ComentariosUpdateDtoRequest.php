<?php

namespace App\Domain\Dto\Request\Comentarios;

use App\Http\Requests\Comentarios\UpdateRequest;

class ComentariosUpdateDtoRequest
{
    public function __construct(
        public readonly string|null $comentario,
        public readonly int $id_modificador,
    ){}
    public static function fromApiRequest(UpdateRequest $request):ComentariosUpdateDtoRequest
    {
        return new self(
            comentario: $request->get(key: 'comentario'),
            id_modificador: $request->user()->id,
        );
    }
}

