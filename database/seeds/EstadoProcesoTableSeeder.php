<?php

use Illuminate\Database\Seeder;
use App\EstadoProceso;

class EstadoProcesoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoProceso::create([
        	'estado_proceso' => 'En proceso'
        ]);

        EstadoProceso::create([
        	'estado_proceso' => 'Finalizado'
        ]);
    }
}
