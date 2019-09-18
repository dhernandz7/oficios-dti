<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
	protected $table = 'asignaciones';
	
	protected $fillable = [
		'oficio_id',
		'oficio_anio',
		'path',
		'tipo_documento_id',
		'user_id'
	];
}
