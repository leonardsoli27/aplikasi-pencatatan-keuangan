<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendapatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendapatan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kelompok');
            $table->foreign('kode_kelompok')->references('kode_kelompok')->on('users')->onDelete('cascade');
            $table->string('suplier', 100)->nullable();
            $table->string('nama_pembeli', 200);
            $table->string('nama_produk', 200);
            $table->integer('jml_produk');
            $table->integer('kas_masuk');
            $table->integer('kas_keluar');
            $table->integer('total');
            $table->string('jenis_pembayaran', 27); // cod atau transfer
            $table->string('status', 100)->nullable();
            $table->date('tgl_masuk');
            $table->string('no_resi', 100)->nullable(); // jika ada
            $table->string('no_pesanan', 100)->nullable();
            $table->string('akun_shopee', 100)->nullable();
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
        Schema::dropIfExists('pendapatan');
    }
}
