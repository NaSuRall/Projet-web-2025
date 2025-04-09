<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->unsignedBigInteger('cohort_id')->nullable()->after('name');
            $table->foreign('cohort_id')->references('id')->on('cohorts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropForeign(['cohort_id']);
            $table->dropColumn('cohort_id');
        });
    }
};
