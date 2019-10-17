<?php

use Illuminate\Database\Seeder;
use App\Departamento;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::create([
        	'departamento' => 'Asuntos Jurídicos'
        ]);

        Departamento::create([
            'departamento' => 'Administrador de Sistema'
        ]);
    }
}
