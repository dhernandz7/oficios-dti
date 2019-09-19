<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'      => 'Administrador',
            'slug'      => 'admin',
            'special'   => 'all-access',
            'description' => 'Control total del sistema'
        ]);

        Role::create([
            'name'      => 'Operador',
            'slug'      => 'operador',
            'special'   => null,
            'description' => 'Puede reservar y adjuntar documentos'
        ]);

        Role::create([
            'name'      => 'Consulta',
            'slug'      => 'consulta',
            'special'   => null,
            'description' => 'Solo puede visualizar los documentos'
        ]);
    }
}
