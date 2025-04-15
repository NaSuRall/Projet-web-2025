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
        Schema::create('boards', function (Blueprint $table) {
            $table->engine('InnoDB');

            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('retro_id');
            $table->unsignedBigInteger('cohort_id');

            $table->timestamps();


            $table->foreign('retro_id')->references('id')->on('retros');
            $table->foreign('cohort_id')->references('id')->on('cohorts');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
};
