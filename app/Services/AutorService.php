<?php

namespace App\Services;

use App\Domain\Dto\Request\Autor\AutorStoreDtoRequest;
use App\Domain\Dto\Request\Autor\AutorUpdateDtoRequest;
use App\Domain\Entities\TbAutor;
use App\Http\Trait\Service;

class AutorService
{
    use Service;
    protected TbAutor $entity;
    public function __construct(TbAutor $autor)
    {
        $this->entity=$autor;
    }

    public function store(AutorStoreDtoRequest $storeDTO){
        return $this->entity::create([
            'id_creador'=> $storeDTO->id_creador,
            'nombre'=> $storeDTO->nombre,
            'biografia'=> $storeDTO->biografia,
            'fecha_nacimiento'=> $storeDTO->fecha_nacimiento,
        ]);
    }

    public function update(AutorUpdateDtoRequest $request, int $id){
        $autor = $this->entity::find($id);
        if(!$autor)
            return false;
        return tap($autor)->update([
            'nombre' => $request->nombre ?? $autor->nombre,
            'biografia' => $request->biografia ?? $autor->biografia,
            'fecha_nacimiento' => $request->fecha_nacimiento ?? $autor->fecha_nacimiento,
            'id_modificador' => $request->id_modificador,
        ]);
    }


}
