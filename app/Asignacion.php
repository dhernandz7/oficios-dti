<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
	protected $table = 'asignacion';

	protected $fillable = [
		'id',
		'oficio_id',
		'oficio_anio',
		'correspondencia_ref',
		'personal',
		'fecha_asignacion',
		'activo',
		'tipo_documento_id',
		'user_id'
	];

	public $timestamps = false;
}
