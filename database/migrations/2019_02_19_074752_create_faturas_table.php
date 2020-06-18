<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proje_id')->unsigned()->index();
            $table->string('faturano');
            $table->string('faturamusteri');
            $table->string('faturadetay');
            $table->string('faturatarih');
            $table->string('faturatotal');
            $table->string('faturavergi');
            $table->string('faturaodeme');
            $table->string('faturaadres');
            $table->foreign('proje_id')
                  ->references('id')
                  ->on('projes')
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
        Schema::dropIfExists('faturas');
    }
}
