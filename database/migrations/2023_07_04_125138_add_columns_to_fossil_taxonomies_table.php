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
        Schema::table('fossil_taxonomies', function (Blueprint $table) {

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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fossil_taxonomies', function (Blueprint $table) {
            $table->dropForeign('fossils_fossil_kingdom_id_foreign');
            $table->dropForeign('fossils_fossil_common_id_foreign');
            $table->dropForeign('fossils_fossil_phylum_id_foreign');
            $table->dropForeign('fossils_fossil_class_id_foreign');
            $table->dropForeign('fossils_fossil_order_id_foreign');
            $table->dropForeign('fossils_fossil_family_id_foreign');
            $table->dropForeign('fossils_fossil_genre_id_foreign');
            $table->dropForeign('fossils_fossil_subgenre_id_foreign');
            $table->dropForeign('fossils_specific_epithet_id_foreign');
            $table->dropForeign('fossils_fossil_subspecies_id_foreign');

            $table->dropColumn('fossil_kingdom_id');
            $table->dropColumn('fossil_common_id');
            $table->dropColumn('fossil_phylum_id');
            $table->dropColumn('fossil_class_id');
            $table->dropColumn('fossil_order_id');
            $table->dropColumn('fossil_family_id');
            $table->dropColumn('fossil_genre_id');
            $table->dropColumn('fossil_subgenre_id');
            $table->dropColumn('specific_epithet_id');
            $table->dropColumn('fossil_subspecies_id');
            //
        });
    }
};
