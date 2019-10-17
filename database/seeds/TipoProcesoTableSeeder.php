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
        	'tipo_proceso' => 'A - Acción de amparo'
        ]);

        TipoProceso::create([
        	'tipo_proceso' => 'B - Inconstitucionalidad'
        ]);

        TipoProceso::create([
        	'tipo_proceso' => 'C - Proceso contencioso-administrativo'
        ]);
    }
}
