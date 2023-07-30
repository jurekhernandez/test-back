<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use App\Domain\Business\AutenticarBusiness;
use Illuminate\Http\JsonResponse;


class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private AutenticarBusiness $autenticar;

    public function __construct(AutenticarBusiness $autenticar)
    {
        $this->autenticar = $autenticar;
    }

    public function authenticate(LoginRequest $request):JsonResponse
    {
        return $this->autenticar->verificarCredenciales($request->post('username'), $request->post('password'));
    }
}
