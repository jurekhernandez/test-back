<?php

/**
 * Created by Reliese Model.
 */

namespace App\Domain\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TbComentarios
 *
 * @property int $id
 * @property int $id_libro
 * @property int $id_usuario
 * @property string|null $comentario
 * @property Carbon|null $fecha_creacion
 * @property Carbon|null $fecha_edicion
 * @property string|null $fecha_eliminacion
 * @property int|null $id_creador
 * @property int|null $id_modificador
 * @property int|null $id_eliminador
 *
 * @property TbLibro $tb_libro
 * @property TbUsuarios $tb_usuarios
 *
 * @package App\Domain\Entities
 */
class TbComentarios extends Model
{
	use SoftDeletes;
	const CREATED_AT = 'fecha_creacion';
	const UPDATED_AT = 'fecha_edicion';
	const DELETED_AT = 'fecha_eliminacion';
	protected $table = 'tb_comentarios';
	protected $dateFormat = 'Y-m-d H:i:s';

	protected $casts = [
		'id_libro' => 'int',
		'id_usuario' => 'int',
		'id_creador' => 'int',
		'id_modificador' => 'int',
		'id_eliminador' => 'int'
	];

	protected $fillable = [
		'id_libro',
		'comentario',
		'id_creador',
		'id_modificador',
		'id_eliminador'
	];

    protected $hidden = [
        'id_modificador',
        'id_eliminador',
        'fecha_edicion',
        'fecha_eliminacion'
    ];

	public function tb_libro()
	{
		return $this->belongsTo(TbLibro::class, 'id_libro');
	}

	public function tb_usuarios()
	{
		return $this->belongsTo(TbUsuarios::class, 'id_usuario');
	}
}
