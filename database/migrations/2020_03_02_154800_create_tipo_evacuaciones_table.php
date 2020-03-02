<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoEvacuacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_evacuaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_evacuaciones');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('tipo_evacuaciones', 'unique_tipo_evacuaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_evacuaciones');
    }
}
