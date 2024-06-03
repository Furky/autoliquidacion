<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamposPersonalizadosTable extends Migration
{
    public function up()
    {
        Schema::create('campospersonalizados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->enum('tipo', ['TEXT', 'NUMBER', 'DATE']);
            $table->unsignedBigInteger('id_servicios');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('campospersonalizados');
    }
}
