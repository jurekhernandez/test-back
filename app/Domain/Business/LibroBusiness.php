<?php

namespace App\Domain\Business;

use App\Domain\Dto\Request\Libro\LibroStoreDtoRequest;
use App\Domain\Dto\Request\Libro\LibroUpdateDtoRequest;
use App\Domain\Entities\TbAutor;
use App\Helpers\Permissions;
use App\Helpers\Response;
use App\Helpers\ReturnId;
use App\Http\Requests\Libro\StoreRequest;
use App\Http\Requests\Libro\UpdateRequest;

use App\Http\Trait\Business;
use App\Services\LibroService;
use Illuminate\Http\JsonResponse;

class LibroBusiness
{
    use Business;
    private LibroService $service;
    private readonly string $action;

    public function __construct(LibroService $service)
    {
        $this->service = $service;
        $this->action='Libro';
    }
    public function store(StoreRequest $request):JsonResponse
    {
        if(Permissions::Can($request,'crear '.$this->action)){
            $dto = LibroStoreDtoRequest::fromApiRequest($request);
            $autor = TbAutor::find($dto->id_autor);
            if(!$autor)
                return Response::NotFound("El autor enviado no fue encontrado");
            $Libro = $this->service->store($dto);
            $LibroId = ReturnId::fromModel($Libro);
            Return Response::created($LibroId);
        }else{
            return Response::Forbiden();
        }
    }
    public function update(UpdateRequest $request, int $id):JsonResponse
    {
        if(Permissions::Can($request,'actualizar '.$this->action)){
            $dto = LibroUpdateDtoRequest::fromApiRequest($request);

            $autor = TbAutor::find($dto->id_autor);
            if($dto->id_autor != null && !$autor )
                return Response::NotFound("El autor enviado no fue encontrado");

            $Libro = $this->service->update($dto, $id);
            if(!$Libro)
                return Response::NotFound();
            return Response::noContent();
        }else{
            return Response::Forbiden();
        }
    }
}
