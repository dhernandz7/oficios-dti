<?php

use Illuminate\Database\Seeder;
use App\TipoDocumento;

class TipoDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::create([
        	'tipo_documento' => 'Oficio'
        ]);

        TipoDocumento::create([
        	'tipo_documento' => 'Dictámen'
        ]);

        TipoDocumento::create([
        	'tipo_documento' => 'Memorándum'
        ]);
    }
}
