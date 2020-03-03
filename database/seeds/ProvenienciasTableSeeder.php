<?php

use Illuminate\Database\Seeder;
use App\Proveniencia;

class ProvenienciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveniencia::create([
        	'proveniencia' => 'Corte de Constitucionalidad'
        ]);

        Proveniencia::create([
        	'proveniencia' => 'Corte Suprema de Justicia'
        ]);

        Proveniencia::create([
        	'proveniencia' => 'Juzgado'
        ]);

        Proveniencia::create([
        	'proveniencia' => 'Sala'
        ]);
    }
}
