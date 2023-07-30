<?php

        namespace App\Http\Controllers;

        use App\Domain\Business\LibroTagBusiness;
        use App\Http\Requests\LibroTag\StoreRequest;
        use App\Http\Requests\LibroTag\UpdateRequest;
        use App\Http\Trait\ApiController;
        use Illuminate\Http\JsonResponse;

        class LibroTagController extends Controller
        {
            use ApiController;

            protected LibroTagBusiness $business;
            public function __construct(LibroTagBusiness $business)
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