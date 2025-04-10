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
        Schema::create('retros', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->id();
            $table->string('name');
            $table->string('promotion');
            $table->unsignedBigInteger('creator_id');
            $table->timestamps();


            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retros');
    }
};
