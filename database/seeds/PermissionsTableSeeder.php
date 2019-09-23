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

        Permission::create([
            'name'          => 'Oficios',
            'slug'          => 'oficios',
            'description'   => 'Visualiza el módulo de oficios'
        ]);

        Permission::create([
            'name'          => 'Dictámenes',
            'slug'          => 'dictamenes',
            'description'   => 'Visualiza el módulo de dictámenes'
        ]);

        Permission::create([
            'name'          => 'Memorándum',
            'slug'          => 'memorandum',
            'description'   => 'Visualiza el módulo de memorándum'
        ]);
    }
}
