<?php

namespace App\Domain\Dto\Response\Autor;

use Illuminate\Database\Eloquent\Collection;

class AutorGetDtoResponse
{
    public static function fromAutores(Collection $autores, int $registroInicial, int $porPagina, int $total){
        return [
            'autores'=>$autores->toArray(),
            'totalRegistros'=>$total,
            'registroInicial'=>$registroInicial,
            'porPagina'=>$porPagina,
            'paginas'=>round((($total/$porPagina)+0.4), 0,),
        ];
    }
}

