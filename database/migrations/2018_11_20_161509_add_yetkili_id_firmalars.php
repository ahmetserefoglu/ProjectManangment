<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYetkiliIdFirmalars extends Migration
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
            $table->integer('yetkili_id')->unsigned()->index();
            $table->foreign('yetkili_id')
                  ->references('id')
                  ->on('yetkilis')
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
        Schema::table('firmalars', function (Blueprint $table) {
            //
            $table->dropColumn('yetkili_id');
        });
    }
}
