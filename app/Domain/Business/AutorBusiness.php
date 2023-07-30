<?php

namespace App\Domain\Business;

use App\Domain\Dto\Request\Autor\AutorStoreDtoRequest;
use App\Domain\Dto\Request\Autor\AutorUpdateDtoRequest;
use App\Helpers\Permissions;
use App\Helpers\Response;
use App\Helpers\ReturnId;
use App\Http\Requests\Autor\StoreRequest;
use App\Http\Requests\Autor\UpdateRequest;

use App\Http\Trait\Business;
use App\Services\AutorService;
use Illuminate\Http\JsonResponse;

class AutorBusiness
{
    use Business;
    private AutorService $service;
    private readonly string $action;

    public function __construct(AutorService $service)
    {
        $this->service = $service;
        $this->action="autor";
    }
    public function store(StoreRequest $request):JsonResponse
    {
        if(Permissions::Can($request,"crear {$this->action}")){
            $dto = AutorStoreDtoRequest::fromApiRequest($request);
            $autor = $this->service->store($dto);
            $autorId = ReturnId::fromModel($autor); //AutorStoreDtoResponse::fromAutor($autor);
            Return Response::created($autorId);
        }else{
            return Response::Forbiden();
        }
    }
    public function update(UpdateRequest $request, int $id):JsonResponse
    {
        if(Permissions::Can($request,"actualizar {$this->action}")){
            $dto = AutorUpdateDtoRequest::fromApiRequest($request);
            $autor = $this->service->update($dto, $id);
            if(!$autor)
                return Response::NotFound();
            return Response::noContent();
        }else{
            return Response::Forbiden();
        }
    }
}
