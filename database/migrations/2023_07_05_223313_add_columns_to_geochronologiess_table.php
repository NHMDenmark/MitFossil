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
        Schema::table('geochronologies', function (Blueprint $table) {

            $table->unsignedBigInteger('eon_id')->nullable();
            $table->unsignedBigInteger('epoche_id')->nullable();
            $table->unsignedBigInteger('era_id')->nullable();
            $table->unsignedBigInteger('period_id')->nullable();
            $table->unsignedBigInteger('age_id')->nullable();

            $table->foreign('eon_id')->references('id')->on('eons');
            $table->foreign('epoche_id')->references('id')->on('epoches');
            $table->foreign('era_id')->references('id')->on('eras');
            $table->foreign('period_id')->references('id')->on('periods');
            $table->foreign('age_id')->references('id')->on('ages');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('geochronologies', function (Blueprint $table) {

            $table->dropForeign(['eon_id']);
            $table->dropForeign(['epoche_id']);
            $table->dropForeign(['era_id']);
            $table->dropForeign(['period_id']);
            $table->dropForeign(['age_id']);
            $table->dropColumn(['eon_id', 'epoche_id', 'era_id', 'period_id', 'age_id']);
            //
        });
    }
};
