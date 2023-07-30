<?php

namespace App\Http\Trait;

use App\Domain\Dto\Request\Generic\DeleteDtoRequest;
use App\Helpers\Constants;
use App\Http\Requests\Generic\GetRequest;

trait Service
{
    public function get(GetRequest $getRequest, int $registroInicial=0, int $porPagina=Constants::LISTADOS['por_pagina']):array
    {
        $registros = $this->entity::select("*")
            ->skip($registroInicial)
            ->take($porPagina)
            ->get();
        $total = $this->entity::count();
        return ['data' => $registros,"total"=>$total];
    }
    public function show(int $id){
        //return $this->entity::find($id)->makeVisible(['id_eliminador']);
        return $this->entity::find($id);
    }

    public function delete(DeleteDtoRequest $request, int $id){
        $registry = $this->entity::find($id);
        if(!$registry)
            return false;

        return $this->entity::where('id','=',$id)
            ->update(['id_eliminador' => $request->id_eliminador , 'fecha_eliminacion' => now()]);
    }
}
