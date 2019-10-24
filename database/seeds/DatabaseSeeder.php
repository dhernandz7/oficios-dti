<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	DepartamentosTableSeeder::class,
        	GenerosTableSeeder::class,
            TipoDocumentoTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsRolesTableSeeder::class,
            TipoProcesoTableSeeder::class,
            PlazoAudienciaTableSeeder::class
        ]);
    }
}
