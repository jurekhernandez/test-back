<?php

namespace App\Services;

use App\Domain\Dto\Request\Libro\LibroStoreDtoRequest;
use App\Domain\Dto\Request\Libro\LibroUpdateDtoRequest;
use App\Domain\Entities\TbLibro;
use App\Http\Trait\Service;

class LibroService
{
    use Service;
    protected TbLibro  $entity;

    public function show(int $id){
        //return $this->entity::find($id)->makeVisible(['id_eliminador']);   pv_libros_tags  getTags
        return $this->entity::where('id','=',$id)->with('tags')->get();

    }
    public function __construct(TbLibro $model)
    {
        $this->entity=$model;
    }

    public function store(LibroStoreDtoRequest $storeDTO){
        return $this->entity::create([
            'nombre'=> $storeDTO->nombre,
            'resumen'=> $storeDTO->resumen,
            'id_autor'=> $storeDTO->id_autor,
            'id_creador'=> $storeDTO->id_creador,
        ]);
    }

    public function update(LibroUpdateDtoRequest $request, int $id){
        $model = $this->entity::find($id);
        if(!$model)
            return false;
        return tap($model)->update([
            'nombre' => $request->nombre ?? $model->nombre,
            'resumen' => $request->resumen ?? $model->resumen,
            'id_autor' => $request->id_autor?? $model->id_autor,
            'id_modificador' => $request->id_modificador,
        ]);
    }

}
