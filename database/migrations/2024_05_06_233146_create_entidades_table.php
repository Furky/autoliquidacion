<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entidades', function (Blueprint $table) {
            $table->id();
            $table->string('cif', 15)->unique();
            $table->string('nombre', 255);
            $table->string('direccion', 255);
            $table->integer('cp');
            $table->string('poblacion', 50);
            $table->string('provincia', 50);
            $table->integer('telefono');
            $table->string('email', 255);
            $table->string('clave', 32);
            $table->integer('validado');
            $table->string('decreto', 255);
            $table->string('logo', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entidades');
    }
};
