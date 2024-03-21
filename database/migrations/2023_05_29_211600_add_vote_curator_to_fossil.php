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
        Schema::table('fossils', function (Blueprint $table) {
            $table->boolean('vote_curator')->default(false);
            $table->boolean('vote_expert')->default(false);
            $table->boolean('vote_fossil_expert')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fossils', function (Blueprint $table) {
            //
        });
    }
};
