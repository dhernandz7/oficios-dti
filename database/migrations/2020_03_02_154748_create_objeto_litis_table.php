<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjetoLitisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objeto_litis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('objeto_de_litis');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('objeto_de_litis', 'unique_objeto_litis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objeto_litis');
    }
}
