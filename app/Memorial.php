<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Memorial extends Model
{
	use SoftDeletes;
	
	protected $table = 'memoriales';
	protected $fillable = [
		'fecha_notificacion',
		'fecha_evacuacion_audiencia',
		'numero_proceso',
		'path',
		'tipo_proceso_id',
		'plazo_audiencia_id',
		'user_id',
		'bloqueado'
	];
}
