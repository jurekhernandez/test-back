<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class Pagination
{
    public static function fromCollection(Collection $datos, int $registroInicial, int $porPagina, int $total){
        return [
            'registries'=>$datos->toArray(),
            'totalRecords'=>$total,
            'startingPoint'=>$registroInicial,
            'perPage'=>$porPagina,
            'Pages'=>round((($total/$porPagina)+0.4), 0,),
        ];
    }
}
