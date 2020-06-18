<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFirmalars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('firmalars', function (Blueprint $table) {
            //
            $table->string('il');
            $table->string('ilce');
            $table->string('ulke');
            $table->string('telefon');
            $table->string('webadresi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('firmalars', function (Blueprint $table) {
            //
            $table->dropColumn('il');
            $table->dropColumn('ilce');
            $table->dropColumn('ulke');
            $table->dropColumn('telefon');
            $table->dropColumn('webadresi');
        });
    }
}
