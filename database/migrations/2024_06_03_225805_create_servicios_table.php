<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->text('descripcion');
            $table->boolean('publicado');
            $table->tinyInteger('tipo'); // 0 for fixed cost, 1 for variable cost
            $table->decimal('importe', 10, 2);
            $table->text('formula')->nullable();
            $table->unsignedBigInteger('id_entidad');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
