<?php

        namespace App\Http\Controllers;

        use App\Domain\Business\TagBusiness;
        use App\Http\Requests\Tag\StoreRequest;
        use App\Http\Requests\Tag\UpdateRequest;
        use App\Http\Trait\ApiController;
        use Illuminate\Http\JsonResponse;

        class TagController extends Controller
        {
            use ApiController;

            protected TagBusiness $business;
            public function __construct(TagBusiness $business)
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