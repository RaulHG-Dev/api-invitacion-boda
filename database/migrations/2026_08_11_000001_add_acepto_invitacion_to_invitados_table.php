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
        Schema::table('invitados', function (Blueprint $table) {
            $table->boolean('acepto_invitacion')->default(false)->after('uuid_invitado');
            $table->timestamp('aceptado_en')->nullable()->after('acepto_invitacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitados', function (Blueprint $table) {
            $table->dropColumn(['acepto_invitacion', 'aceptado_en']);
        });
    }
};
