<?php

namespace App\Http\Trait;

use App\Domain\Dto\Request\Generic\DeleteDtoRequest;
use App\Helpers\Constants;
use App\Helpers\Pagination;
use App\Helpers\Permissions;
use App\Helpers\Response;
use App\Http\Requests\Generic\DeleteRequest;
use App\Http\Requests\Generic\GetRequest;
use App\Http\Requests\Generic\ShowRequest;
use Illuminate\Http\JsonResponse;

trait Business
{
    public function get(GetRequest $request):JsonResponse
    {
        if(Permissions::Can($request,"leer {$this->action}")){
            $registroInicial= $request->get('registroInicial') ?? 0;
            $porPagina= $request->get('porPagina') ?? Constants::LISTADOS['por_pagina'];
            $registros= $this->service->get($request, $registroInicial, $porPagina);
            $respuesta=  Pagination::fromCollection($registros['data'], $registroInicial, $porPagina, $registros['total']);
            return Response::success($respuesta);
        }else{
            return Response::Forbiden();
        }
    }
    public function show(ShowRequest $request, int $id):JsonResponse
    {
        if(Permissions::Can($request,"leer {$this->action}")){
            $autor = $this->service->show($id);
            if(!$autor)
                return Response::NotFound();
            return Response::success(data:[$autor] ) ;
        }else{
            return Response::Forbiden();
        }
    }
    public function delete(DeleteRequest $request, int $id):JsonResponse
    {
        if(Permissions::Can($request,"eliminar {$this->action}")){
            $dto = DeleteDtoRequest::fromApiRequest($request);
            $problem = $this->service->delete($dto, $id);
            if(!$problem)
                return Response::NotFound();

            return Response::noContent();
        }else{
            return Response::Forbiden();
        }
    }
}
