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
        Schema::create('epoches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('period_id')->nullable();
            $table->string('description', 50);
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('period_id')->references('id')->on('periods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epoches');
    }
};
