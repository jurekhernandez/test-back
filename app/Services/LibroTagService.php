<?php

namespace App\Services;

use App\Domain\Dto\Request\LibroTag\LibroTagStoreDtoRequest;
use App\Domain\Dto\Request\LibroTag\LibroTagUpdateDtoRequest;
use App\Domain\Entities\PvLibrosTags;
use App\Domain\Entities\TbLibroTag;
use App\Http\Trait\Service;

class LibroTagService
{
    use Service;
    protected PvLibrosTags  $entity;
    public function __construct(PvLibrosTags $model)
    {
        $this->entity=$model;
    }

    public function store(LibroTagStoreDtoRequest $storeDTO){
        return $this->entity::create([
            'id_creador'=> $storeDTO->id_creador,
            'id_libro'=> $storeDTO->id_libro,
            'id_tag'=> $storeDTO->id_tag,
        ]);
    }

    public function update(LibroTagUpdateDtoRequest $request, int $id){
        $model = $this->entity::find($id);
        if(!$model)
            return false;
        return tap($model)->update([
            'property' => $request->property ?? $model->property,
            'id_modificador' => $request->id_modificador,
        ]);
    }

}
