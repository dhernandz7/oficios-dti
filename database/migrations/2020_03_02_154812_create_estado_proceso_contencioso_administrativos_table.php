<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoProcesoContenciosoAdministrativoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_proceso_contencioso_administrativo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estado_proceso_contencioso_administrativo');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('estado_proceso_contencioso_administrativo', 'unique_estado_proceso_contencioso_administrativo')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_proceso_contencioso_administrativo');
    }
}
