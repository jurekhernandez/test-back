<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class ReturnId
{
    public static function fromModel(Model $model){
        return [
            'id'=>$model->id
        ];
    }
}
