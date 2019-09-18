<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('oficio_id')->unsigned()->nullable();
            $table->integer('oficio_anio')->unsigned()->nullable();
            $table->string('path')->nullable();
            $table->integer('tipo_documento_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tipo_documento_id', 'fk_asignaciones_tipo_documento')->references('id')->on('tipo_documento');
            $table->foreign('user_id', 'fk_asignaciones_users')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignaciones');
    }
}
