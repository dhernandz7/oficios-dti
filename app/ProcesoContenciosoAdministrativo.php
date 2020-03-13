<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcesoContenciosoAdministrativo extends Model
{
	protected $table = 'procesos_contenciosos_administrativos';

	protected $fillable = [
		'numero_de_proceso',
		'proveniente_id',
		'fecha_de_notificacion',
		'objeto_litis_id',
		'nombre_de_entidad_demandante',
		'nombre_de_demandado',
		'tipo_evacuacion_id',
		'estado_proceso_id',
		'anotacion'
	];
}
