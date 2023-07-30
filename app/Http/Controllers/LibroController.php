<?php

        namespace App\Http\Controllers;

        use App\Domain\Business\LibroBusiness;
        use App\Http\Requests\Libro\StoreRequest;
        use App\Http\Requests\Libro\UpdateRequest;
        use App\Http\Trait\ApiController;
        use Illuminate\Http\JsonResponse;

        class LibroController extends Controller
        {
            use ApiController;

            protected LibroBusiness $business;
            public function __construct(LibroBusiness $business)
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