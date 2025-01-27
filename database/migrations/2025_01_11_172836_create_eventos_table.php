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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('lugar');
            $table->dateTime('fecha_y_hora');
            $table->string('estado_evento');
            $table->string('privacidad_evento');
            $table->foreignId('usuario_fk')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('ticket_fk')->constrained('tickets')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
