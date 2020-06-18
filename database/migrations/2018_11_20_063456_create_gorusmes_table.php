<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGorusmesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gorusmes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('GorusmeKonusu')->nullable();
            $table->dateTime('Tarih');
            $table->integer('department_id')->unsigned()->index();
            $table->string('Yontemi')->nullable();
            $table->string('GorusmeDetayi')->nullable();
            $table->string('OnemDerecesi')->nullable();
            $table->timestamps();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('department_id')
                  ->references('id')
                  ->on('department')
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
        Schema::dropIfExists('gorusmes');
    }
}
