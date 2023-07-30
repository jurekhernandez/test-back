<?php

namespace App\Http\Trait;

use App\Http\Requests\Generic\DeleteRequest;
use App\Http\Requests\Generic\GetRequest;
use App\Http\Requests\Generic\ShowRequest;
use Illuminate\Http\JsonResponse;

Trait ApiController
{
    public function get(GetRequest $getRequest):JsonResponse
    {
        return $this->business->get($getRequest);
    }
    public function show(ShowRequest $showRequest, int $id):JsonResponse
    {
        return $this->business->show($showRequest, $id);
    }
    public function delete(DeleteRequest $deleteRequest, int $id):JsonResponse
    {
        return $this->business->delete($deleteRequest, $id);
    }
}
