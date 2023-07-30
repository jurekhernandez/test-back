<?php

        namespace App\Http\Controllers;

        use App\Domain\Business\ComentariosBusiness;
        use App\Http\Requests\Comentarios\StoreRequest;
        use App\Http\Requests\Comentarios\UpdateRequest;
        use App\Http\Trait\ApiController;
        use Illuminate\Http\JsonResponse;

        class ComentariosController extends Controller
        {
            use ApiController;

            protected ComentariosBusiness $business;
            public function __construct(ComentariosBusiness $business)
            {
                $this->business = $business;
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