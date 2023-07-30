<?php

namespace App\Services;

use App\Domain\Dto\Request\Comentarios\ComentariosStoreDtoRequest;
use App\Domain\Dto\Request\Comentarios\ComentariosUpdateDtoRequest;
use App\Domain\Entities\TbComentarios;
use App\Http\Trait\Service;

class ComentariosService
{
    use Service;
    protected TbComentarios  $entity;
    public function __construct(TbComentarios $model)
    {
        $this->entity=$model;
    }

    public function store(ComentariosStoreDtoRequest $storeDTO){
        return $this->entity::create([
            'id_creador'=> $storeDTO->id_creador,
            'comentario'=> $storeDTO->comentario,
            'id_libro'=> $storeDTO->id_libro,
        ]);
    }

    public function update(ComentariosUpdateDtoRequest $request, int $id){
        $model = $this->entity::find($id);
        if(!$model)
            return false;
        return tap($model)->update([
            'comentario' => $request->comentario ?? $model->comentario,
            'id_modificador' => $request->id_modificador,
        ]);
    }

}
