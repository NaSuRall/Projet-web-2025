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
        Schema::create('retrospectives', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();

            $table->unsignedBigInteger('cohort_id');
            $table->unsignedBigInteger('created_by'); // ou null si tu veux rendre ça facultatif

            $table->string('name');
            $table->timestamps();

            // Clés étrangères
            $table->foreign('cohort_id')->references('id')->on('cohorts')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retrospectives');
    }
};
