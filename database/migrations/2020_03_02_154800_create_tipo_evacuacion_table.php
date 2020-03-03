<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoEvacuacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_evacuacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_evacuacion');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('tipo_evacuacion', 'unique_tipo_evacuacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_evacuacion');
    }
}
