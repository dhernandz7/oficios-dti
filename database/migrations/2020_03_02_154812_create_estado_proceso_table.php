<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoProcesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_proceso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estado_proceso');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('estado_proceso', 'unique_estado_proceso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_proceso');
    }
}
