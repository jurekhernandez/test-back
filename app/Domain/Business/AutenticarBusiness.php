<?php
namespace App\Domain\Business;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response;
use Laravel\Sanctum\NewAccessToken;

class AutenticarBusiness
{
    public function verificarCredenciales(string $username, string $password):JsonResponse
    {
        $usuario = $this->getUserToLogin($username, $password);
        if (!$usuario) {
            return Response::notAuthorized(["message" => "Error en los datos ingresados"]);
        }
        $token = $this->createNewToken($usuario);
        return Response::success(data:  $token);
    }

    private function getUserToLogin(string $username, string $password):Authenticatable|null
    {
        if (Auth::attempt(['nombre_usuario' => $username, 'password' => $password, 'fecha_eliminacion' => null])) {
            return auth()->user();
        }
        return null;
    }

    private function createNewToken( Authenticatable $usuario): array
    {
        $permisos = $usuario->pr_perfiles->getPermisos()->select('permiso')->get()->toArray();
        if(!$permisos){
            return false;
        }
        $permisos_array=[];
        foreach ($permisos as $permiso){
            $permisos_array[]=$permiso['permiso'];
        }
        return [
            'token'=>$usuario->createToken($usuario->mail, $permisos_array)->plainTextToken,
            'permisos'=>$permisos_array,
            'nombre'=> $usuario->nombres.' '.$usuario->apellidos,
        ];
    }
}




/*

---- vistas y permisos ----
SOLICITAR_TASACION
- solicitar_tasacion                            st_st

TASACIONES_EN_BORRADOR
- ver_listado_tasaciones_borrador_propias       tb_vltbp

TASACIONES_SOLICITADAS
- ver_listado_tasaciones_solicitadas_empresa    ts_vltse
- ver_listado_tasaciones_solicitadas_propias    ts_vltsp
- borrar_tasacion                               ts_bt

AGENDA DE TASACIONES
- ver_agenda_tasaciones_global                  at_vatg
- ver_mi_agenda_tasaciones                      at_vmat
- asignar_tasacion                              at_ast
- borrar_tasacion                               at_bt

BUSCAR_TASACION
- buscar_tasacion_todas                         bt_btt
- buscar_tasacion_solicitadas_empresa           bt_btse
- buscar_tasaciones_solicitadas                 bt_bts
- buscar_tasacion_asignadas                     bt_bta

VER TASACION
- reasignar_tasacion                            vt_rt
- visar_informe                                 vt_vi
- reconsiderar_informe                          vt_ri
- ingresar_deposito-viatico                     vt_idv
- solicitar-retasacion                          vt_srt
- solicitar-reconsideracion                     vt_src

LISTA_TASADORES y LISTA_CLIENTES
- administrar_usuarios                          au_au

BANDEJA_DE_MENSAJES
- ver_mensajes_recibidos                        bm_vmr
- ver_mensajes_enviados                         bm_vme
- enviar_mensaje                                bm_em

MODIFICAR_DATOS
- modificar_datos                               md_md

x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x
x-x-x-x-x Pendientes -x-x-x-x-x
x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x

CREAR_REPORTE_ESTADISTICO
- crear_reporte_estadistico

CREAR_REPORTE_CONTABLE
- crear_reporte_contable

X_LISTAS_PARA_PAGAR

MODULO_DE_PAGOS

CREAR_ARCHIVO_MENSUAL_(coopeuch)

x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x
x-x-x-x-x Pendientes -x-x-x-x-x
x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x

*/
