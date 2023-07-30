<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response as LaravelResponse;

class Response
{
    // ------------------ Code 200

    static public function success(array $data):JsonResponse
    {
        return LaravelResponse::json(["status" => "Solicitud exitosa", "data" => $data], 200);
    }

    static public function created(array $data):JsonResponse
    {
        return LaravelResponse::json(["status" => "Creado exitosamente", "data" => $data], 201);
    }

    static public function noContent():JsonResponse
    {
        return LaravelResponse::json(["status" => "Sin contenido"], 204);
    }


    // ------------------ Code 400
    static public function BadRequest(array $data):JsonResponse
    {
        return LaravelResponse::json(["status" => "Fallo", "data" => $data], 400);
    }

    static public function notAuthorized(array $data):JsonResponse
    {
        return LaravelResponse::json(["status" => "fail", "data" => $data], 401);
    }


    static public function Forbiden():JsonResponse
    {
        return LaravelResponse::json(["status" => "Sin autorización para hacer uso de este recurso"], 403);
    }

    static public function NotFound(string $message="Contenido no encontrado"):JsonResponse
    {
        return LaravelResponse::json(["status" => "Error", "message" => $message], 404);
    }
}
