<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYetkilisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yetkilis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('firma_id')->unsigned()->index();
            $table->string('adi');
            $table->string('soyadi');
            $table->string('email');
            $table->string('telefon');
            $table->foreign('firma_id')
                  ->references('id')
                  ->on('firmalars')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yetkilis');
    }
}
