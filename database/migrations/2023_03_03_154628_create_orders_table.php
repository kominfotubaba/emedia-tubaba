<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('no_pengajuan');
            $table->string('id_paket');
            $table->string('tahun');
            $table->string('no_order');
            $table->string('email');
            $table->string('jenis_media');
            $table->string('nama_media');
            $table->string('nama_biro');
            $table->string('nama_pimred');
            $table->string('nama_perusahaan');
            $table->string('nama_paket');
            $table->string('detail_paket');
            $table->integer('jumlah_paket');
            $table->string('nilai_order');
            $table->string('total_nilai_order');
            $table->enum('status', ['tunggu', 'proses', 'terkirim', 'nego', 'setuju', 'cancel']);
            $table->enum('pesan', ['kirim', 'belum']);
            $table->string('keterangan');
            $table->string('id_ekatalog');
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
        Schema::dropIfExists('orders');
    }
};
