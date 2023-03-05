<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTujuanpengajuanPengajuanPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_tujuanpengajuan', function (Blueprint $table) {
            $table->unsignedInteger('pengajuan_id');
            $table->foreign('pengajuan_id')->references('id')->on('pengajuans')->onDelete('cascade');
            $table->unsignedInteger('tujuanpengajuan_id');
            $table->foreign('tujuanpengajuan_id')->references('id')->on('tujuanpengajuans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_tujuanpengajuan');
    }
}
