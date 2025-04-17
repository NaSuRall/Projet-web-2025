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
        Schema::table('boards', function (Blueprint $table) {
            // Supprimer la contrainte existante
            Schema::table('boards', function (Blueprint $table) {
                $table->dropForeign(['retro_id']);
            });

            // Ajouter la nouvelle contrainte avec ON DELETE CASCADE
            Schema::table('boards', function (Blueprint $table) {
                $table->foreign('retro_id')
                    ->references('id')
                    ->on('retros')
                    ->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boards', function (Blueprint $table) {
            $table->dropForeign(['retro_id']);
        });

        Schema::table('boards', function (Blueprint $table) {
            $table->foreign('retro_id')
                ->references('id')
                ->on('retros');
        });
    }
};
