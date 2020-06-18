<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesajlarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesajlars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kullanici_adi');
            $table->string('gonderen_kisi');
            $table->string('mesaj');
            $table->string('onemdurumu');
            $table->string('onaydurumu');
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
        Schema::dropIfExists('mesajlars');
    }
}
