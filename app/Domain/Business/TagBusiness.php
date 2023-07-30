<?php

namespace App\Domain\Business;

use App\Domain\Dto\Request\Tag\TagStoreDtoRequest;
use App\Domain\Dto\Request\Tag\TagUpdateDtoRequest;
use App\Helpers\Permissions;
use App\Helpers\Response;
use App\Helpers\ReturnId;
use App\Http\Requests\Tag\StoreRequest;
use App\Http\Requests\Tag\UpdateRequest;

use App\Http\Trait\Business;
use App\Services\TagService;
use Illuminate\Http\JsonResponse;

class TagBusiness
{
    use Business;
    private TagService $service;
    private readonly string $action;

    public function __construct(TagService $service)
    {
        $this->service = $service;
        $this->action='Tag';
    }
    public function store(StoreRequest $request):JsonResponse
    {
        if(Permissions::Can($request,'crear '.$this->action)){
            $dto = TagStoreDtoRequest::fromApiRequest($request);
            $Tag = $this->service->store($dto);
            $TagId = ReturnId::fromModel($Tag);
            Return Response::created($TagId);
        }else{
            return Response::Forbiden();
        }
    }
    public function update(UpdateRequest $request, int $id):JsonResponse
    {
        if(Permissions::Can($request,'actualizar '.$this->action)){
            $dto = TagUpdateDtoRequest::fromApiRequest($request);
            $Tag = $this->service->update($dto, $id);
            if(!$Tag)
                return Response::NotFound();
            return Response::noContent();
        }else{
            return Response::Forbiden();
        }
    }
}
