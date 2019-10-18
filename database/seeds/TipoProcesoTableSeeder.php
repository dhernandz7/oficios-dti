<?php

use Illuminate\Database\Seeder;
use App\TipoProceso;

class TipoProcesoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoProceso::create([
        	'tipo_proceso' => 'Acción de amparo'
        ]);

        TipoProceso::create([
        	'tipo_proceso' => 'Inconstitucionalidad'
        ]);

        TipoProceso::create([
        	'tipo_proceso' => 'Proceso contencioso-administrativo'
        ]);
    }
}
