<?php

/**
 * Created by Reliese Model.
 */

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PrPerfiles
 *
 * @property int $id
 * @property string|null $nombre
 * @property int|null $id_creador
 * @property int|null $id_modificador
 * @property int|null $id_eliminador
 *
 * @property Collection|PvPerfilesPermisos[] $pv_perfiles_permisos
 * @property Collection|TbUsuarios[] $tb_usuarios
 *
 * @package App\Domain\Entities
 */
class PrPerfiles extends Model
{
	protected $table = 'pr_perfiles';
	public $timestamps = false;
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
		'id_eliminador'
	];

    protected $hidden = [
        'id_modificador',
        'id_eliminador',
    ];

	public function pv_perfiles_permisos()
	{
		return $this->hasMany(PvPerfilesPermisos::class, 'id_perfil');
	}

    public function getPermisos(){
        return $this->belongsToMany( PrPermisos::class,'pv_perfiles_permisos','id_perfil', 'id_permiso');
        // un perfil tiene muchos permisos, esta relación se guarda en la tabla pivote pv_perfiles_permisos
        // en esta le entregamos la clase objetiva, la tabla pivote, el ID propio en la tabla pivote y finalmente el ID objetivo en la tabla pivote
    }

	public function tb_usuarios()
	{
		return $this->hasMany(TbUsuarios::class, 'id_perfil');
	}
}
