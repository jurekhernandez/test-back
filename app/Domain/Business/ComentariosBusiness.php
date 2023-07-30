<?php

namespace App\Domain\Business;

use App\Domain\Dto\Request\Comentarios\ComentariosStoreDtoRequest;
use App\Domain\Dto\Request\Comentarios\ComentariosUpdateDtoRequest;
use App\Domain\Entities\TbLibro;
use App\Helpers\Permissions;
use App\Helpers\Response;
use App\Helpers\ReturnId;
use App\Http\Requests\Comentarios\StoreRequest;
use App\Http\Requests\Comentarios\UpdateRequest;

use App\Http\Trait\Business;
use App\Services\ComentariosService;
use Illuminate\Http\JsonResponse;

class ComentariosBusiness
{
    use Business;
    private ComentariosService $service;
    private readonly string $action;

    public function __construct(ComentariosService $service)
    {
        $this->service = $service;
        $this->action='Comentario';
    }
    public function store(StoreRequest $request):JsonResponse
    {
        if(Permissions::Can($request,'crear '.$this->action)){
            $dto = ComentariosStoreDtoRequest::fromApiRequest($request);
            $libro = TbLibro::find($dto->id_libro);
            if(!$libro)
                return Response::NotFound("El libro enviado no fue encontrado");
            $Comentarios = $this->service->store($dto);
            $ComentariosId = ReturnId::fromModel($Comentarios);
            Return Response::created($ComentariosId);
        }else{
            return Response::Forbiden();
        }
    }
    public function update(UpdateRequest $request, int $id):JsonResponse
    {
        if(Permissions::Can($request,'actualizar '.$this->action)){
            $dto = ComentariosUpdateDtoRequest::fromApiRequest($request);
            $Comentarios = $this->service->update($dto, $id);
            if(!$Comentarios)
                return Response::NotFound();
            return Response::noContent();
        }else{
            return Response::Forbiden();
        }
    }
}
