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
        	'departamento' => 'Director'
        ]);
        Departamento::create([
        	'departamento' => 'Secretaria'
        ]);
        Departamento::create([
        	'departamento' => 'Redes'
        ]);
        Departamento::create([
        	'departamento' => 'Infraestructura'
        ]);
        Departamento::create([
        	'departamento' => 'Soporte técnico'
        ]);
        Departamento::create([
        	'departamento' => 'Desarrollo'
        ]);
    }
}
