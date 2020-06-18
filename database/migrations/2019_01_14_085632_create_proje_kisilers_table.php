<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjeKisilersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proje_kisilers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proje_id')->unsigned()->index();
            $table->string('kisi1');
            $table->string('durum1');
            $table->string('kisi2');
            $table->string('durum2');
            $table->string('kisi3');
            $table->string('durum3');
            $table->string('kisi4');
            $table->string('durum4');
            $table->string('kisi5');
            $table->string('durum5');
            $table->string('kisi6');
            $table->string('durum6');
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
        Schema::dropIfExists('proje_kisilers');
    }
}
