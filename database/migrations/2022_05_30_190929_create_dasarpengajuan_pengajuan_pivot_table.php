<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDasarpengajuanPengajuanPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dasarpengajuan_pengajuan', function (Blueprint $table) {
            $table->unsignedInteger('pengajuan_id');
            $table->foreign('pengajuan_id')->references('id')->on('pengajuans')->onDelete('cascade');
            $table->unsignedInteger('dasarpengajuan_id');
            $table->foreign('dasarpengajuan_id')->references('id')->on('dasarpengajuans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dasarpengajuan_pengajuan');
    }
}
