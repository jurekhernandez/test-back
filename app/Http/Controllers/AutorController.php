<?php

namespace App\Http\Controllers;

use App\Domain\Business\AutorBusiness;
use App\Http\Requests\Autor\StoreRequest;
use App\Http\Requests\Autor\UpdateRequest;
use App\Http\Trait\ApiController;
use Illuminate\Http\JsonResponse;

class AutorController extends Controller
{
    use ApiController;

    protected AutorBusiness $business;
    public function __construct(AutorBusiness $autorBusiness)
    {
        $this->business = $autorBusiness;
    }
    public function store(StoreRequest $storeRequest):JsonResponse
    {
        return $this->business->store($storeRequest);
    }
    public function update(UpdateRequest $updateRequest, int $id):JsonResponse
    {
        return $this->business->update($updateRequest, $id);
    }



}
