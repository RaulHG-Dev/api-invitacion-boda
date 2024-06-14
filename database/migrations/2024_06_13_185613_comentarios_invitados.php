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
        Schema::create('comentarios_invitados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150)->default('');
            $table->string('comentario', 255)->default('');
            $table->unsignedBigInteger('id_invitado');
            $table->foreign('id_invitado')->references('id')->on('invitados');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios_invitados');
    }
};
