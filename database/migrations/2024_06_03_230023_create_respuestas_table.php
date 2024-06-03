<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasTable extends Migration
{
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_servicio');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_campo')->nullable();
            $table->text('valor');
            $table->decimal('importe', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
}
