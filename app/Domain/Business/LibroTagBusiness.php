<?php

namespace App\Domain\Business;

use App\Domain\Dto\Request\LibroTag\LibroTagStoreDtoRequest;
use App\Domain\Dto\Request\LibroTag\LibroTagUpdateDtoRequest;
use App\Domain\Entities\PrTags;
use App\Domain\Entities\TbLibro;
use App\Helpers\Permissions;
use App\Helpers\Response;
use App\Helpers\ReturnId;
use App\Http\Requests\LibroTag\StoreRequest;
use App\Http\Requests\LibroTag\UpdateRequest;

use App\Http\Trait\Business;
use App\Services\LibroTagService;
use Illuminate\Http\JsonResponse;

class LibroTagBusiness
{
    use Business;
    private LibroTagService $service;
    private readonly string $action;

    public function __construct(LibroTagService $service)
    {
        $this->service = $service;
        $this->action='LibroTag';
    }
    public function store(StoreRequest $request):JsonResponse
    {
        if(Permissions::Can($request,'crear '.$this->action)){
            $dto = LibroTagStoreDtoRequest::fromApiRequest($request);
            $libro = TbLibro::find($dto->id_libro);
            if(!$libro)
                return Response::NotFound("Libro no encontrado");

            $tag = PrTags::find($dto->id_tag);
            if(!$tag)
                return Response::NotFound("Tag no encontrado");

            $LibroTag = $this->service->store($dto);
            $LibroTagId = ReturnId::fromModel($LibroTag);
            Return Response::created($LibroTagId);
        }else{
            return Response::Forbiden();
        }
    }
    public function update(UpdateRequest $request, int $id):JsonResponse
    {
        if(Permissions::Can($request,'actualizar '.$this->action)){
            $dto = LibroTagUpdateDtoRequest::fromApiRequest($request);
            $LibroTag = $this->service->update($dto, $id);
            if(!$LibroTag)
                return Response::NotFound();
            return Response::noContent();
        }else{
            return Response::Forbiden();
        }
    }
}
