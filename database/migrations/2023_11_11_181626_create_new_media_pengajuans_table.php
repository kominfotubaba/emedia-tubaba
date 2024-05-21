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
        Schema::create('new_media_pengajuans', function (Blueprint $table) {

            // $table->string('nama_perusahaan');
            // $table->string('nama_pimred');
            // $table->string('alamat_perusahaan');
            // $table->string('tlpn_perusahaan');
            // $table->string('email_perusahaan');
            // $table->string('npwp_perusahaan');
            // $table->string('akta_perusahaan');
            // $table->string('kumham_perusahaan');
            // $table->string('wartawan_kompeten_perusahaan');
            // $table->string('nama_percetakan')->nullable();
            // $table->string('alamat_percetakan')->nullable();
            // $table->string('file_npwp_perusahaan')->nullable();
            // $table->string('file_akta_perusahaan')->nullable();
            // $table->string('file_kumham_perusahaan')->nullable();
            // $table->string('file_wartawan_kompeten_perusahaan')->nullable();
            // $table->string('file_dewan_pers_perusahaan')->nullable();
            // $table->string('file_afiliasi_perusahaan')->nullable();
            // $table->string('file_spt_perusahaan')->nullable();
            // $table->string('file_domisili_perusahaan')->nullable();
            // $table->string('file_kuasa_perwakilan')->nullable();
            // $table->string('file_kerjasama')->nullable();
            // $table->string('file_izin_ipp')->nullable();
            // // perwawkilan
            // $table->string('nama_media');
            // $table->string('nama_biro_perwakilan');
            // $table->string('alamat_perwakilan');
            // $table->string('tlpn_perwakilan');
            // $table->string('email_perwakilan');
            // $table->string('ktp_perwakilan');
            // $table->string('kk_perwakilan');
            // $table->string('npwp_perwakilan');
            // $table->string('kompetensi_perwakilan');
            // $table->string('jenis_rekening');
            // $table->string('nama_bank');
            // $table->string('pemilik_rekening');
            // $table->string('no_rekening');
            // $table->string('file_ktp_perwakilan')->nullable();
            // $table->string('file_kk_perwakilan')->nullable();
            // $table->string('file_npwp_perwakilan')->nullable();
            // $table->string('file_kopetensi_perwakilan')->nullable();
            // $table->string('file_afiliasi_perwakilan')->nullable();
            // $table->string('file_domisili_perwakilan')->nullable();
            // $table->string('file_kode_etik_perwakilan')->nullable();
            // $table->string('file_pernyataan_media_perwakilan')->nullable();
            // $table->string('file_rekening')->nullable();
            // $table->string('file_signature_data')->nullable();

            $table->id();
            $table->string('id_user', 40);
            $table->string('pengajuan_no');
            // Data Badan Hukum
            $table->string('namaPerusahaan')->nullable();
            $table->string('namaPenanggungJawab')->nullable();
            $table->string('namaPimred')->nullable();
            $table->string('kumhamPerusahaan')->nullable();
            $table->string('alamatPerusahaan')->nullable();
            $table->string('tlpnPerusahaan')->nullable();
            $table->string('emailPerusahaan', 100)->nullable();
            $table->string('npwpPerusahaan')->nullable();
            $table->string('nibPerusahaan')->nullable();
            $table->string('noKbki')->nullable();
            $table->string('izinIpp')->nullable();
            $table->string('namaPercetakan')->nullable();
            $table->string('alamatPercetakan')->nullable();
            $table->string('alamatProvPerusahaan')->nullable();
            $table->string('alamatKabPerusahaan')->nullable();
            $table->string('statusKswp')->nullable();
            $table->string('noKlbi')->nullable();
            $table->string('fileSuratPernyataanPimred')->nullable();
            $table->string('fileKumhamPerusahaan')->nullable();
            $table->string('fileNpwpPerusahaan')->nullable();
            $table->string('fileNibPerusahaan')->nullable();
            $table->string('fileIzinIpp')->nullable();

            // Data Media
            $table->string('jenis_media');
            $table->string('namaMedia')->nullable();
            $table->string('serfikatUkwPimred')->nullable();
            $table->string('namaBank')->nullable();
            $table->string('pemilikRekening')->nullable();
            $table->string('noRekening')->nullable();
            $table->string('verifikasiDewanPers')->nullable();
            $table->string('jenisSerfikatUkwPimred')->nullable();
            $table->string('afiliasiPerusahaan')->nullable();
            $table->string('domisiliRedaksiMedia')->nullable();
            $table->string('kanalKhusus')->nullable();
            $table->string('jenisRekening')->nullable();
            $table->string('fileSerfikatUkwPimred')->nullable();
            $table->string('fileAfiliasiPerusahaan')->nullable();
            $table->string('fileDomisiliRedaksiMedia')->nullable();
            $table->string('fileKanalKhusus')->nullable();
            $table->string('fileRekening')->nullable();

            // Kualifikasi Media
            $table->string('tahunBerdiriMedia')->nullable();
            $table->string('jenisJangkauanSiarMediaElektronik')->nullable();
            $table->string('jangkauanSiarMediaElektronik')->nullable();
            $table->string('jumlahOplahMediaCetakPerMinggu')->nullable();
            $table->string('fileJumlahOplahMediaCetakPerMinggu')->nullable();
            $table->string('jumlahKontenBeritaAktif')->nullable();

            // Perwakilan Media
            $table->string('namaPerwakilan')->nullable();
            $table->string('nomorKKPerwakilan')->nullable();
            $table->string('nomorKtpPerwakilan')->nullable();
            $table->string('npwpPerwakilan')->nullable();
            $table->string('fileNpwpPerwakilan')->nullable();
            $table->string('jenisSerfikatUkwPerwakilan')->nullable();
            $table->string('serfikatUkwPerwakilan')->nullable();
            $table->string('fileSerfikatUkwPerwakilan')->nullable();
            $table->string('afiliasiPersPerwakilan')->nullable();
            $table->string('fileafiliasiPersPerwakilan')->nullable();
            $table->string('alamatPerwakilan')->nullable();
            $table->string('tlpnPerwakilan')->nullable();
            $table->string('emailPerwakilan')->nullable();
            $table->string('alamatProvPerwakilan')->nullable();
            $table->string('alamatKabPerwakilan')->nullable();
            $table->string('alamatKecPerwakilan')->nullable();
            $table->string('alamatKelPerwakilan')->nullable();

            // status dan parameter
            $table->enum('status', ['ajukan', 'edit', 'tolak', 'terima']);
            $table->enum('nilai', ['A', 'B', 'C', 'D'])->nullable();
            $table->string('nilaiDalamAngka', 20)->nullable();
            $table->longText('keterangan')->nullable();
            $table->string('tahun_pengajuan');
            $table->enum('buka_edit', ['buka', 'tidak'])->default('tidak');
            $table->enum('send_mail', ['0', '1'])->default('0');
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
        Schema::dropIfExists('new_media_pengajuans');
    }

    //  public function up()
    // {
    //     Schema::create('new_media_pengajuans', function (Blueprint $table) {
    //         $table->id();
    //         $table->timestamps();
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    // public function down()
    // {
    //     Schema::dropIfExists('new_media_pengajuans');
    // }
};
