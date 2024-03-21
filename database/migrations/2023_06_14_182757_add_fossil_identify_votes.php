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
        Schema::table('fossil_identifies', function (Blueprint $table) {
            $table->json('vote_users_json')->nullable();
            $table->unsignedBigInteger('vote_curator_id')->nullable();
            $table->unsignedBigInteger('vote_expert_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fossil_identifies', function (Blueprint $table) {
            $table->dropColumn('vote_users_json');
            $table->dropColumn('vote_curator_id');
            $table->dropColumn('vote_expert_id');
        });
    }
};
