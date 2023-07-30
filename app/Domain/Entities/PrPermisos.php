<?php

/**
 * Created by Reliese Model.
 */

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PrPermisos
 *
 * @property int $id
 * @property string|null $permiso
 * @property string|null $nombre
 *
 * @property Collection|PvPerfilesPermisos[] $pv_perfiles_permisos
 *
 * @package App\Domain\Entities
 */
class PrPermisos extends Model
{
	protected $table = 'pr_permisos';
	public $timestamps = false;
	protected $dateFormat = 'Y-m-d H:i:s';

	protected $fillable = [
		'permiso',
		'nombre'
	];

	public function pv_perfiles_permisos()
	{
		return $this->hasMany(PvPerfilesPermisos::class, 'id_permiso');
	}
}
