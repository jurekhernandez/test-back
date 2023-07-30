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
 * Class TbLibro
 *
 * @property int $id
 * @property string|null $nombre
 * @property int $id_autor
 * @property Carbon|null $fecha_creacion
 * @property Carbon|null $fecha_edicion
 * @property string|null $fecha_eliminacion
 * @property int|null $id_creador
 * @property int|null $id_modificador
 * @property int|null $id_eliminador
 *
 * @property TbAutor $tb_autor
 * @property Collection|PvLibrosTags[] $pv_libros_tags
 * @property Collection|TbComentarios[] $tb_comentarios
 *
 * @package App\Domain\Entities
 */
class TbLibro extends Model
{
	use SoftDeletes;
	const CREATED_AT = 'fecha_creacion';
	const UPDATED_AT = 'fecha_edicion';
	const DELETED_AT = 'fecha_eliminacion';
	protected $table = 'tb_libro';
	protected $dateFormat = 'Y-m-d H:i:s';

	protected $casts = [
		'id_autor' => 'int',
		'id_creador' => 'int',
		'id_modificador' => 'int',
		'id_eliminador' => 'int'
	];

    protected $hidden = [
        'id_modificador',
        'id_eliminador',
        'fecha_edicion',
        'fecha_eliminacion',
        'pivot'
    ];
	protected $fillable = [
		'nombre',
		'resumen',
		'id_autor',
		'id_creador',
		'id_modificador',
		'id_eliminador'
	];

	public function tb_autor()
	{
		return $this->belongsTo(TbAutor::class, 'id_autor');
	}

	public function pv_libros_tags()
	{
		return $this->hasMany(PvLibrosTags::class, 'id_libro');
	}

    public function tags(){
        return $this->belongsToMany( PrTags::class,'pv_libros_tags','id_libro', 'id_tag');
        // un perfil tiene muchos permisos, esta relación se guarda en la tabla pivote pv_perfiles_permisos
        // en esta le entregamos la clase objetiva, la tabla pivote, el ID propio en la tabla pivote y finalmente el ID objetivo en la tabla pivote
    }


    public function tb_comentarios()
	{
		return $this->hasMany(TbComentarios::class, 'id_libro');
	}
}
