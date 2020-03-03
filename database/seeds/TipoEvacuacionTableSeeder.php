<?php

use Illuminate\Database\Seeder;
use App\TipoEvacuacion;

class TipoEvacuacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoEvacuacion::create([
        	'tipo_evacuacion' => 'Contestación de demanda'
        ]);

        TipoEvacuacion::create([
        	'tipo_evacuacion' => 'Día para la vista'
        ]);

        TipoEvacuacion::create([
        	'tipo_evacuacion' => 'Evacuación de audiencia 48 hora'
        ]);

        TipoEvacuacion::create([
        	'tipo_evacuacion' => 'Otro'
        ]);
    }
}
