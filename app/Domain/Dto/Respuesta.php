<?php

namespace App\Domain\Dto;

class Respuesta
{
      public int $statusCode;
      public string $message;
      public array $data;
      public function __constructor(int $statusCode, string $message, array $data=[]){
          $this->statusCode=$statusCode;
          $this->message=$message;
          $this->data = $data;
    }
}
