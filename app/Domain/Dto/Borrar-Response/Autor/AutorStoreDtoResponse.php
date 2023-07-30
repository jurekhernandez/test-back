<?php

namespace App\Domain\Dto\Response\Autor;

use App\Domain\Entities\TbAutor;

class AutorStoreDtoResponse
{
    public function __construct(
        public readonly int $id
    ){}

    public static function fromAutor(TbAutor $autor){
        return [
            'id'=>$autor->id
        ];
    }
}
