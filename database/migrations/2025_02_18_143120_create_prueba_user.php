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
        Schema::create('prueba_users', function (Blueprint $table) {
            $table->id();
            $table->string('codemp'); // Este es el ID de la empresa
            $table->string('codper'); // Código del perfil
            $table->string('cedper'); // Cédula del perfil
            $table->string('nomper'); // Nombre del perfil
            $table->string('apeper'); // Apellido del perfil
            $table->date('fecnacper'); // Fecha de nacimiento del perfil
            $table->date('fecingadmpubper'); // Fecha de ingreso administrativo público
            $table->date('fecingper'); // Fecha de ingreso al perfil
            $table->string('telmovper')->nullable(); // Teléfono móvil (puede ser nulo)
            $table->enum('sexper', ['M', 'F'])->nullable(); // Sexo del perfil, puede ser M o F
            $table->string('coreleper')->nullable(); // Correo electrónico, puede ser nulo

            $table->timestamps(); // Añade las columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prueba_user');
    }
};
