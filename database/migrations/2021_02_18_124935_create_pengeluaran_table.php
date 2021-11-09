<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kelompok');
            $table->foreign('kode_kelompok')->references('kode_kelompok')->on('users')->onDelete('cascade');
            $table->string('keterangan', 200);
            $table->string('kategori', 200);
            $table->integer('biaya_iklan')->nullable();
            $table->integer('pajak_iklan')->nullable();
            $table->integer('total');
            $table->date('tgl_pengeluaran');
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
        Schema::dropIfExists('pengeluaran');
    }
}
