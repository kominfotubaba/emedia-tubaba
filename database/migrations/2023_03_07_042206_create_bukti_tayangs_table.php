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
        Schema::create('bukti_tayangs', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->string('no_order');
            $table->string('file_bukti_tayang')->nullable();
            $table->string('file_sp2d')->nullable();
            $table->string('pbj')->nullable();
            $table->string('pbj_nip')->nullable();
            $table->string('kpa')->nullable();
            $table->string('kpa_nip')->nullable();
            $table->string('pptk')->nullable();
            $table->string('pptk_nip')->nullable();
            $table->string('media')->nullable();
            $table->string('pengelola_barang')->nullable();
            $table->string('pengelola_barang_nip')->nullable();
            $table->string('bendahara')->nullable();
            $table->string('bendahara_nip')->nullable();
            $table->string('admin')->nullable();
            $table->enum('status', ['tunggu', 'cek', 'terima', 'tolak', 'selesai']);
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('bukti_tayangs');
    }
};
