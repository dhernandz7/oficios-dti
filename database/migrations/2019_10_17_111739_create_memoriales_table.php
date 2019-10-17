<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemorialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memoriales', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_notificacion');
            $table->date('fecha_evaluacion_audiencia');
            $table->string('numero_proceso');
            $table->string('path')->nullable();
            $table->integer('tipo_proceso_id')->unsigned();
            $table->integer('plazo_audiencia_id')->unsigned();
            $table->integer('user_id')->unsigned()->comment('Id del usuario que ingresó el memorial');
            $table->integer('bloqueado')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tipo_proceso_id', 'fk_memoriales_tipo_proceso')->references('id')->on('tipo_proceso');
            $table->foreign('plazo_audiencia_id', 'fk_memoriales_plazo_audiencia')->references('id')->on('plazo_audiencia');
            $table->foreign('user_id', 'fk_memoriales_users')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memoriales');
    }
}
