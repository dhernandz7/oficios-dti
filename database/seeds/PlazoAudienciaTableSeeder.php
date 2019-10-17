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
        	'plazo_audiencia' => 'A - 24 horas'
        ]);

        PlazoAudiencia::create([
        	'plazo_audiencia' => 'B - 48 horas'
        ]);

        PlazoAudiencia::create([
        	'plazo_audiencia' => 'C - 15 días'
        ]);
    }
}
