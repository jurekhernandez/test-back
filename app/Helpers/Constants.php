<?php

namespace App\Helpers;

class Constants
{
    Const LISTADOS=[
        "por_pagina"=>5,
    ];
    Const PERMISOS=[
        "crear libro" => "l-c",
        "leer libro" => "l-r",
        "actualizar libro" => "l-u",
        "eliminar libro" => "l-d",
	    "crear autor" => "a-c",
        "leer autor" => "a-r",
        "actualizar autor" => "a-u",
        "eliminar autor" => "a-d",
        "crear tag" => "t-c",
        "leer tag" => "t-r",
        "actualizar tag" => "t-u",
        "eliminar tag" => "t-d",
        "crear comentario" => "c-c",
        "leer comentario" => "c-r",
        "actualizar comentario" => "c-u",
        "eliminar comentario" => "c-d",
        "crear librotag" => "lt-c",
        "leer librotag" => "lt-r",
        "actualizar librotag" => "lt-u",
        "eliminar librotag" => "lt-d",
    ];
}
