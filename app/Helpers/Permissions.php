<?php

namespace App\Helpers;
class Permissions{

    static public function Can($request, $permiso){
        $permiso = strtolower($permiso);
        if(! \key_exists($permiso, Constants::PERMISOS)){
            exit(("jajaj sigue intentando $permiso"));
        }
        if($request->user()->tokenCan(Constants::PERMISOS[$permiso])){
            return true;
        }
        return false;

    }
}
