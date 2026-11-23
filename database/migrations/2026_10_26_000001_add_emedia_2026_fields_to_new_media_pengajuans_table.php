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
        Schema::table('new_media_pengajuans', function (Blueprint $table) {
            // DATA PERUSAHAAN PERS - Badan Hukum
            $table->string('alamatWebsite')->nullable()->after('alamatKabPerusahaan');
            $table->string('alamatKecPerusahaan')->nullable()->after('alamatPerusahaan');
            $table->string('namaPimprus')->nullable()->after('namaPimred');
            // DATA WARTAWAN BIRO/PERWAKILAN MEDIA
            $table->string('organisasiWartawan')->nullable()->after('afiliasiPersPerwakilan');
            $table->string('organisasiPerusahaanPers')->nullable()->after('organisasiWartawan');
            $table->string('fileSuratKeteranganWartawan')->nullable()->after('fileafiliasiPersPerwakilan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_media_pengajuans', function (Blueprint $table) {
            $table->dropColumn([
                'alamatWebsite',
                'alamatKecPerusahaan',
                'namaPimprus',
                'organisasiWartawan',
                'organisasiPerusahaanPers',
                'fileSuratKeteranganWartawan',
            ]);
        });
    }
};
