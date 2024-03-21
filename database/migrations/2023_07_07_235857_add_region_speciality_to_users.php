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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('fossil_speciality_id')->nullable();
            $table->unsignedBigInteger('fossil_region_id')->nullable();

            $table->foreign('fossil_speciality_id')->references('id')->on('fossil_specialities');
            $table->foreign('fossil_region_id')->references('id')->on('fossil_regions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
