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
        Schema::create('fossils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fossil_kingdom_id')->nullable();
            $table->unsignedBigInteger('fossil_common_id')->nullable();
            $table->unsignedBigInteger('fossil_phylum_id')->nullable();
            $table->unsignedBigInteger('fossil_class_id')->nullable();
            $table->unsignedBigInteger('fossil_order_id')->nullable();
            $table->unsignedBigInteger('fossil_family_id')->nullable();
            $table->unsignedBigInteger('fossil_genre_id')->nullable();
            $table->unsignedBigInteger('fossil_subgenre_id')->nullable();
            $table->unsignedBigInteger('specific_epithet_id')->nullable();
            $table->unsignedBigInteger('fossil_subspecies_id')->nullable();
            $table->string('author', 100)->nullable();
            $table->unsignedBigInteger('fossil_taxonomy_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('county_id')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('municipality', 100)->nullable();
            $table->string('locality_name', 100)->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->boolean('hide_location');
            $table->unsignedBigInteger('eon_id')->nullable();
            $table->unsignedBigInteger('era_id')->nullable();
            $table->unsignedBigInteger('period_id')->nullable();
            $table->unsignedBigInteger('epoch_id')->nullable();
            $table->unsignedBigInteger('age_id')->nullable();
            $table->string('group', 50)->nullable();
            $table->string('formation', 50)->nullable();
            $table->string('member', 50)->nullable();
            $table->unsignedBigInteger('geochronology_id')->nullable();
            $table->integer('length');
            $table->integer('width');
            $table->integer('height');
            $table->string('identifier', 100)->nullable();
            $table->string('collector', 100)->nullable();
            $table->date('date_find');
            $table->text('notes')->nullable();
            $table->text('personal_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('fossil_kingdom_id')->references('id')->on('fossil_kingdoms');
            $table->foreign('fossil_common_id')->references('id')->on('fossil_commons');
            $table->foreign('fossil_phylum_id')->references('id')->on('fossil_phylums');
            $table->foreign('fossil_class_id')->references('id')->on('fossil_classes');
            $table->foreign('fossil_order_id')->references('id')->on('fossil_orders');
            $table->foreign('fossil_family_id')->references('id')->on('fossil_families');
            $table->foreign('fossil_genre_id')->references('id')->on('fossil_genres');
            $table->foreign('fossil_subgenre_id')->references('id')->on('fossil_subgenres');
            $table->foreign('specific_epithet_id')->references('id')->on('specific_epithets');
            $table->foreign('fossil_subspecies_id')->references('id')->on('fossil_subspecies');
            $table->foreign('fossil_taxonomy_id')->references('id')->on('fossil_taxonomies');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('county_id')->references('id')->on('counties');
            $table->foreign('eon_id')->references('id')->on('eons');
            $table->foreign('era_id')->references('id')->on('eras');
            $table->foreign('period_id')->references('id')->on('periods');
            $table->foreign('epoch_id')->references('id')->on('epoches');
            $table->foreign('age_id')->references('id')->on('ages');
            $table->foreign('geochronology_id')->references('id')->on('geochronologies');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fossils');
    }
};
