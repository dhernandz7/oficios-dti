<?php

use Illuminate\Database\Seeder;
use App\PlazoAudiencia;

class PlazoAudienciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlazoAudiencia::create([
        	'plazo_audiencia' => '24 horas'
        ]);

        PlazoAudiencia::create([
        	'plazo_audiencia' => '48 horas'
        ]);

        PlazoAudiencia::create([
        	'plazo_audiencia' => '15 días'
        ]);
    }
}
