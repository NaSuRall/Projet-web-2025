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
        Schema::create('cards', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('description');
            $table->integer('position')->nullable();
            $table->unsignedBigInteger('column_id');
            $table->timestamps();


            $table->foreign('column_id')->references('id')->on('columns');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
