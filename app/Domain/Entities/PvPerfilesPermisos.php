<?php

/**
 * Created by Reliese Model.
 */

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PvPerfilesPermisos
 *
 * @property int $id
 * @property int|null $id_perfil
 * @property int|null $id_permiso
 * @property int|null $id_creador
 * @property int|null $id_modificador
 * @property int|null $id_eliminador
 *
 * @property PrPerfiles|null $pr_perfiles
 * @property PrPermisos|null $pr_permisos
 *
 * @package App\Domain\Entities
 */
class PvPerfilesPermisos extends Model
{
	protected $table = 'pv_perfiles_permisos';
	public $timestamps = false;
	protected $dateFormat = 'Y-m-d H:i:s';

	protected $casts = [
		'id_perfil' => 'int',
		'id_permiso' => 'int',
		'id_creador' => 'int',
		'id_modificador' => 'int',
		'id_eliminador' => 'int'
	];

	protected $fillable = [
		'id_perfil',
		'id_permiso',
		'id_creador',
		'id_modificador',
		'id_eliminador'
	];

    protected $hidden = [
        'id_modificador',
        'id_eliminador',
    ];

	public function pr_perfiles()
	{
		return $this->belongsTo(PrPerfiles::class, 'id_perfil');
	}

	public function pr_permisos()
	{
		return $this->belongsTo(PrPermisos::class, 'id_permiso');
	}
}
