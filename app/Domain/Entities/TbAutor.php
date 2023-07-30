<?php

/**
 * Created by Reliese Model.
 */

namespace App\Domain\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TbAutor
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $biografia
 * @property Carbon|null $fecha_nacimiento
 * @property Carbon|null $fecha_creacion
 * @property Carbon|null $fecha_edicion
 * @property string|null $fecha_eliminacion
 * @property int|null $id_creador
 * @property int|null $id_modificador
 * @property int|null $id_eliminador
 *
 * @property Collection|TbLibro[] $tb_libros
 *
 * @package App\Domain\Entities
 */
class TbAutor extends Model
{
	use SoftDeletes;
	const CREATED_AT = 'fecha_creacion';
	const UPDATED_AT = 'fecha_edicion';
	const DELETED_AT = 'fecha_eliminacion';
	protected $table = 'tb_autor';
	protected $dateFormat = 'Y-m-d H:i:s';

	protected $casts = [
		'id_creador' => 'int',
		'id_modificador' => 'int',
		'id_eliminador' => 'int'
	];

	protected $fillable = [
		'nombre',
		'id_creador',
		'id_modificador',
		'id_eliminador',
        'biografia',
        'fecha_nacimiento'
	];

    protected $hidden = [
        'id_modificador',
        'id_eliminador',
        'fecha_edicion',
        'fecha_eliminacion'
    ];

	public function tb_libros()
	{
		return $this->hasMany(TbLibro::class, 'id_autor');
	}
}
