<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanTembusanPengajuanPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_tembusanpengajuan', function (Blueprint $table) {
            $table->unsignedInteger('pengajuan_id');
            $table->foreign('pengajuan_id')->references('id')->on('pengajuans')->onDelete('cascade');
            $table->unsignedInteger('tembusanpengajuan_id');
            $table->foreign('tembusanpengajuan_id')->references('id')->on('tembusanpengajuans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_tembusanpengajuan');
    }
}
