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
        Schema::create('ages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('epoch_id')->nullable();
            $table->string('description', 50);
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('epoch_id')->references('id')->on('epoches');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ages');
    }
};
