<?php

/**
 * Created by Reliese Model.
 */

namespace App\Domain\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class TbUsuarios
 *
 * @property int $id
 * @property string|null $nombre_usuario
 * @property string|null $password
 * @property string|null $nombres
 * @property string|null $apellidos
 * @property string|null $mail
 * @property int $id_perfil
 * @property Carbon|null $fecha_creacion
 * @property Carbon|null $fecha_edicion
 * @property string|null $fecha_eliminacion
 * @property int|null $id_creador
 * @property int|null $id_modificador
 * @property int|null $id_eliminador
 *
 * @property PrPerfiles $pr_perfiles
 * @property Collection|TbComentarios[] $tb_comentarios
 *
 * @package App\Domain\Entities
 */
/*
    $usuario = new App\Domain\Entities\TbUsuarios;
    $usuario->nombre_usuario='jhernandez';
    $usuario->password='123';
    $usuario->id_perfil=1;
    $usuario->save();
*/

class TbUsuarios extends Authenticatable
{
	use SoftDeletes, HasApiTokens, HasFactory, Notifiable;
	const CREATED_AT = 'fecha_creacion';
	const UPDATED_AT = 'fecha_edicion';
	const DELETED_AT = 'fecha_eliminacion';
	protected $table = 'tb_usuarios';
	protected $dateFormat = 'Y-m-d H:i:s';

	protected $casts = [
		'id_perfil' => 'int',
		'id_creador' => 'int',
		'id_modificador' => 'int',
		'id_eliminador' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'nombre_usuario',
		'password',
		'nombres',
		'apellidos',
		'mail',
		'id_perfil',
		'id_creador',
		'id_modificador',
		'id_eliminador'
	];
    public function setpasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
	public function pr_perfiles()
	{
		return $this->belongsTo(PrPerfiles::class, 'id_perfil');
	}

	public function tb_comentarios()
	{
		return $this->hasMany(TbComentarios::class, 'id_usuario');
	}
}
