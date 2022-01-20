<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->string('details_en', 191)->nullable()->after('details');
            $table->text('description_en')->nullable()->after('description');
            $table->string('season_en', 191)->nullable()->after('season');
            $table->text('ingredients_en')->nullable()->after('ingredients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->dropColumn('details_en');
            $table->dropColumn('description_en');
            $table->dropColumn('season_en');
            $table->dropColumn('ingredients_en');
        });
    }
}
