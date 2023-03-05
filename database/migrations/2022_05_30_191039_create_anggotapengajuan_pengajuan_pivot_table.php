<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotapengajuanPengajuanPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotapengajuan_pengajuan', function (Blueprint $table) {
            $table->unsignedInteger('pengajuan_id');
            $table->foreign('pengajuan_id')->references('id')->on('pengajuans')->onDelete('cascade');
            $table->unsignedInteger('anggotapengajuan_id');
            $table->foreign('anggotapengajuan_id')->references('id')->on('anggotapengajuans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggotapengajuan_pengajuan');
    }
}
