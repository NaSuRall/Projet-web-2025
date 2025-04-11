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
        Schema::create('users_cohorts', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cohorts_id');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cohorts_id')->references('id')->on('cohorts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_cohorts');
    }
};
