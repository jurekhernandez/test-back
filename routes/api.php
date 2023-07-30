<?php

use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\LibroTagController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', [LoginController::class, 'authenticate']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('autor',[AutorController::class,'get']);
    Route::post('autor', [AutorController::class, 'store']);
    Route::get('autor/{id}', [AutorController::class, 'show']);
    Route::put('autor/{id}', [AutorController::class, 'update']);
    Route::delete('autor/{id}', [AutorController::class, 'delete']);

    Route::get('libro',[LibroController::class,'get']);
    Route::post('libro', [LibroController::class, 'store']);
    Route::get('libro/{id}', [LibroController::class, 'show']);
    Route::put('libro/{id}', [LibroController::class, 'update']);
    Route::delete('libro/{id}', [LibroController::class, 'delete']);
    //Route::post('libro/{id}')

    Route::get('tag',[TagController::class,'get']);
    Route::post('tag', [TagController::class, 'store']);
    Route::get('tag/{id}', [TagController::class, 'show']);
    Route::put('tag/{id}', [TagController::class, 'update']);
    Route::delete('tag/{id}', [TagController::class, 'delete']);

    Route::get('comentario',[ComentariosController::class,'get']);
    Route::post('comentario', [ComentariosController::class, 'store']);
    Route::get('comentario/{id}', [ComentariosController::class, 'show']);
    Route::put('comentario/{id}', [ComentariosController::class, 'update']);
    Route::delete('comentario/{id}', [ComentariosController::class, 'delete']);

   // Route::get('librotag',[LibroTagController::class,'get']);
    Route::post('librotag', [LibroTagController::class, 'store']);
   // Route::get('librotag/{id}', [LibroTagController::class, 'show']);
   // Route::put('librotag/{id}', [LibroTagController::class, 'update']);
    Route::delete('librotag/{id}', [LibroTagController::class, 'delete']);
});
