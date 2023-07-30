<?php

/**
 * Created by Reliese Model.
 */

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PvLibrosTags
 *
 * @property int $id
 * @property int $id_libro
 * @property int $id_tag
 * @property int|null $id_creador
 * @property int|null $id_modificador
 * @property int|null $id_eliminador
 *
 * @property TbLibro $tb_libro
 * @property PrTags $pr_tags
 *
 * @package App\Domain\Entities
 */
class PvLibrosTags extends Model
{
    use SoftDeletes;
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_edicion';
    const DELETED_AT = 'fecha_eliminacion';
	protected $table = 'pv_libros_tags';
	protected $dateFormat = 'Y-m-d H:i:s';

	protected $casts = [
		'id_libro' => 'int',
		'id_tag' => 'int',
		'id_creador' => 'int',
		'id_modificador' => 'int',
		'id_eliminador' => 'int'
	];

	protected $fillable = [
		'id_libro',
		'id_tag',
		'id_creador',
		'id_modificador',
		'id_eliminador'
	];

    protected $hidden = [
        'id_modificador',
        'id_eliminador'
    ];
	public function tb_libro()
	{
		return $this->belongsTo(TbLibro::class, 'id_libro');
	}

	public function pr_tags()
	{
		return $this->belongsTo(PrTags::class, 'id_tag');
	}
}
