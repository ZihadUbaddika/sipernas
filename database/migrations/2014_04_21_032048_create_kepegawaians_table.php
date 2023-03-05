<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKepegawaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepegawaians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nip')->length(18);
            $table->string('pangkat');
            $table->string('golongan');
            $table->string('foto');
            $table->string('email');
            $table->string('no_hp');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kepegawaians');
    }
}
