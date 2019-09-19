<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'          => 'Módulo administrador',
            'slug'          => 'admin',
            'description'   => 'Visualiza el módulo del administrador'
        ]);
        
        Permission::create([
            'name'          => 'Módulo documentos',
            'slug'          => 'documentos',
            'description'   => 'Visualiza el módulo de documentos'
        ]);
    }
}
