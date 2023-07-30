<?php

namespace App\Services;

use App\Domain\Dto\Request\Tag\TagStoreDtoRequest;
use App\Domain\Dto\Request\Tag\TagUpdateDtoRequest;
use App\Domain\Entities\PrTags;
use App\Http\Trait\Service;

class TagService
{
    use Service;
    protected PrTags  $entity;
    public function __construct(PrTags $model)
    {
        $this->entity=$model;
    }

    public function store(TagStoreDtoRequest $storeDTO){
        return $this->entity::create([
            'id_creador'=> $storeDTO->id_creador,
            'nombre'=> $storeDTO->nombre,
        ]);
    }

    public function update(TagUpdateDtoRequest $request, int $id){
        $model = $this->entity::find($id);
        if(!$model)
            return false;
        return tap($model)->update([
            'nombre' => $request->nombre ?? $model->nombre,
            'id_modificador' => $request->id_modificador,
        ]);
    }

}
