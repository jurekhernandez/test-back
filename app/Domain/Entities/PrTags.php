<?php

/**
 * Created by Reliese Model.
 */

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PrTags
 *
 * @property int $id
 * @property string|null $nombre
 * @property int|null $id_creador
 * @property int|null $id_modificador
 * @property int|null $id_eliminador
 *
 * @property Collection|PvLibrosTags[] $pv_libros_tags
 *
 * @package App\Domain\Entities
 */
class PrTags extends Model
{
    use SoftDeletes;
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_edicion';
    const DELETED_AT = 'fecha_eliminacion';
	protected $table = 'pr_tags';
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
        'id_creador',
        'fecha_edicion',
        'fecha_eliminacion',
        'fecha_creacion',
        'pivot'
    ];

	public function pv_libros_tags()
	{
		return $this->hasMany(PvLibrosTags::class, 'id_tag');
	}
}
