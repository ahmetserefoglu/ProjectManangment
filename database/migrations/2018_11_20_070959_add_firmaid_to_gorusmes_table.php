<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFirmaidToGorusmesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gorusmes', function (Blueprint $table) {
            //
            $table->string('GorusenKisi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gorusmes', function (Blueprint $table) {
            //
            $table->dropColumn('GorusenKisi');
        });
    }
}
