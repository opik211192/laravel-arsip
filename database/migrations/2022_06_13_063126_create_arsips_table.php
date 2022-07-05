<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arsips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_arsip_id');
            // $table->string('judul_arsip');
            $table->string('lokasi_arsip');
            $table->unsignedBigInteger('jenis_id');
            $table->string('no_berkas');
            $table->string('no_box');
            $table->string('tahun');
            $table->string('pencipta_arsip');
            $table->string('uraian_arsip');
            $table->string('file_arsip');
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            //ini untuk jenis klasifikasi
            $table->foreign('jenis_id')->references('id')->on('jenis');

            //ini untuk jenis arsip
            $table->foreign('jenis_arsip_id')->references('id')->on('jenis_arsips');

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
        Schema::dropIfExists('arsips');
    }
}
