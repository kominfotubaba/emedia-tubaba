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
        Schema::create('media_pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('pengajuan_no');
            $table->string('jenis_media');
            $table->string('nama_perusahaan');
            $table->string('nama_pimred');
            $table->string('alamat_perusahaan');
            $table->string('tlpn_perusahaan');
            $table->string('email_perusahaan');
            $table->string('npwp_perusahaan');
            $table->string('akta_perusahaan');
            $table->string('kumham_perusahaan');
            $table->string('wartawan_kompeten_perusahaan');
            $table->string('nama_percetakan')->nullable();
            $table->string('alamat_percetakan')->nullable();
            $table->string('file_npwp_perusahaan')->nullable();
            $table->string('file_akta_perusahaan')->nullable();
            $table->string('file_kumham_perusahaan')->nullable();
            $table->string('file_wartawan_kompeten_perusahaan')->nullable();
            $table->string('file_dewan_pers_perusahaan')->nullable();
            $table->string('file_afiliasi_perusahaan')->nullable();
            $table->string('file_spt_perusahaan')->nullable();
            $table->string('file_domisili_perusahaan')->nullable();
            $table->string('file_kuasa_perwakilan')->nullable();
            $table->string('file_kerjasama')->nullable();
            $table->string('file_izin_ipp')->nullable();
            // perwawkilan
            $table->string('nama_media');
            $table->string('nama_biro_perwakilan');
            $table->string('alamat_perwakilan');
            $table->string('tlpn_perwakilan');
            $table->string('email_perwakilan');
            $table->string('ktp_perwakilan');
            $table->string('kk_perwakilan');
            $table->string('npwp_perwakilan');
            $table->string('kompetensi_perwakilan');
            $table->string('jenis_rekening');
            $table->string('nama_bank');
            $table->string('pemilik_rekening');
            $table->string('no_rekening');
            $table->string('tahun_pengajuan');
            $table->string('file_ktp_perwakilan')->nullable();
            $table->string('file_kk_perwakilan')->nullable();
            $table->string('file_npwp_perwakilan')->nullable();
            $table->string('file_kopetensi_perwakilan')->nullable();
            $table->string('file_afiliasi_perwakilan')->nullable();
            $table->string('file_domisili_perwakilan')->nullable();
            $table->string('file_kode_etik_perwakilan')->nullable();
            $table->string('file_pernyataan_media_perwakilan')->nullable();
            $table->string('file_rekening')->nullable();
            $table->string('file_signature_data')->nullable();
            $table->longText('keterangan')->nullable();
            $table->enum('status', ['ajukan', 'edit', 'tolak', 'terima']);
            $table->enum('nilai', ['A', 'B', 'C', 'D'])->nullable();
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
        Schema::dropIfExists('media_pengajuans');
    }
};
