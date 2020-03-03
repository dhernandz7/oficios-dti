<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesosContenciososAdministrativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procesos_contenciosos_administrativos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->string('numero_de_proceso');
            $table->integer('proveniente_id')->unsigned();
            $table->date('fecha_de_notificacion');
            $table->integer('objeto_litis_id')->unsigned();
            $table->string('nombre_de_entidad_demandante');
            $table->string('nombre_de_demandado');
            $table->integer('tipo_evacuacion_id')->unsigned();
            $table->integer('estado_proceso_id')->unsigned();
            $table->string('anotacion')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('proveniente_id', 'fk_procesos_contenciosos_administrativos_proveniencias')->references('id')->on('proveniencias');
            $table->foreign('objeto_litis_id', 'fk_objeto_litis_procesos_contenciosos_administrativos')->references('id')->on('objeto_litis');
            $table->foreign('tipo_evacuacion_id', 'fk_procesos_contenciosos_administrativos_tipo_evacuacion')->references('id')->on('tipo_evacuacion');
            $table->foreign('estado_proceso_id', 'fk_estado_proceso_procesos_contenciosos_administrativos')->references('id')->on('estado_proceso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procesos_contenciosos_administrativos');
    }
}
