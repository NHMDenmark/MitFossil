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
            $table->dropColumn('email');
            $table->dropColumn('email_verified_at');
            $table->dropColumn('zip_code');
            $table->dropColumn('year_birth');
            $table->dropColumn('name');
            $table->dropColumn('picture');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at', $precision = 0);
            $table->integer('zip_code')->nullable();
            $table->integer('year_birth')->nullable();
            $table->string('name');
            $table->string('picture')->nullable();
        });
    }
};
