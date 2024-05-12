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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nif', 9)->unique();
            $table->string('nombre', 50);
            $table->string('apellido1', 50);
            $table->string('apellido2', 50);
            $table->string('direccion', 255);
            $table->integer('cp');
            $table->string('poblacion', 50);
            $table->string('provincia', 50);
            $table->string('telefono', 9);
            $table->string('email', 191)->unique(); // Reducido a 191 caracteres
            $table->string('clave', 32);
            $table->integer('validado');
            $table->integer('rol');
            $table->string('identidad', 255);
            $table->string('declaracion', 255);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
