<?php

namespace App\Domain\Dto\Request\Generic;

class DeleteDtoRequest
{
    public function __construct(
        public readonly int $id_eliminador,
    ){}

    public static function fromApiRequest(\App\Http\Requests\Generic\DeleteRequest $request):DeleteDtoRequest
    {
        return new self(
            id_eliminador:$request->user()->id,
        );
    }
}
