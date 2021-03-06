<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFirmaidToProjesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projes', function (Blueprint $table) {
            //
            $table->integer('firma_id')->unsigned()->index();
            $table->foreign('firma_id')
                  ->references('id')
                  ->on('firmalars')
                  ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projes', function (Blueprint $table) {
            //
            $table->dropColumn('firma_id');
        });
    }
}
