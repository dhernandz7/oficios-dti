<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvenienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveniencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('proveniencia');
            $table->timestamps();
            $table->softDeletes();
            
            $table->unique('proveniencia', 'unique_proveniencia');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveniencias');
    }
}
