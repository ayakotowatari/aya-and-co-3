<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStateIdToPostagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postages', function (Blueprint $table) {
            //
            $table->bigInteger('state_id')->nullable()->unsigned()->after('courier_id');

            $table->foreign("state_id")->references("id")->on("states");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('postages', function (Blueprint $table) {
            //
            $table->dropColumn('state_id');
        });
    }
}
