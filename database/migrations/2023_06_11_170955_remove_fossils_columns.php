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
            $table->dropForeign('fossils_fossil_taxonomy_id_foreign');
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

            $table->dropColumn('fossil_taxonomy_id');
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
