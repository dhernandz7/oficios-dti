<?php

use Illuminate\Database\Seeder;
use App\ObjetoLitis;

class ObjetoLitisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ObjetoLitis::create([
        	'objeto_litis' => 'Aclaración y/o Ampliación'
        ]);

        ObjetoLitis::create([
        	'objeto_litis' => 'Amparo'
        ]);

        ObjetoLitis::create([
        	'objeto_litis' => 'Casación'
        ]);

        ObjetoLitis::create([
        	'objeto_litis' => 'Contencioso Administrativo'
        ]);

        ObjetoLitis::create([
        	'objeto_litis' => 'Inconstitucionalidad'
        ]);

        ObjetoLitis::create([
        	'objeto_litis' => 'Otro'
        ]);
    }
}
