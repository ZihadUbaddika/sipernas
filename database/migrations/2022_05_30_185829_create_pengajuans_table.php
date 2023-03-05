<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->increments('id');
            //Pengajuan
            $table->string('nama_kegiatan');
            $table->string('jenis');
            $table->unsignedInteger('penanggung_jawab');
            $table->unsignedInteger('supervisor');
            $table->unsignedInteger('pengendali_teknis');
            $table->unsignedInteger('ketua_tim');
            $table->unsignedInteger('wilayah');
            $table->string('objek');
            $table->string('ruang_lingkup');
            $table->date('tgl_pengajuan');
            $table->date('tgl_berangkat');
            $table->date('tgl_kembali');
            $table->string('uraian');
            //Status pengajuan
            $table->string('status_pengajuan');
            $table->string('keterangan_pengajuan')->nullable();
            //SPT
            $table->string('no_spt')->nullable();
            $table->date('tgl_terbit')->nullable();
            //LHP
            $table->string('no_lhp')->nullable();
            $table->string('berkas')->nullable();
            $table->date('tgl_submit')->nullable();
            //Timestamps
            $table->timestamps();
            //Foreign key
            $table->foreign('penanggung_jawab')->references('id')->on('kepegawaians')->onDelete('cascade');
            $table->foreign('supervisor')->references('id')->on('kepegawaians')->onDelete('cascade');
            $table->foreign('wilayah')->references('id')->on('wilayahs')->onDelete('cascade');
            $table->foreign('pengendali_teknis')->references('id')->on('kepegawaians')->onDelete('cascade');
            $table->foreign('ketua_tim')->references('id')->on('kepegawaians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuans');
    }
}
