<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('new_media_pengajuans', function (Blueprint $table) {
            $table->text('fileBuktiKeanggotaanOrganisasiWartawan')->nullable()->after('fileSuratKeteranganWartawan');
            $table->text('fileBuktiKeanggotaanOrganisasiPerusahaanPers')->nullable()->after('fileBuktiKeanggotaanOrganisasiWartawan');
        });
    }

    public function down()
    {
        Schema::table('new_media_pengajuans', function (Blueprint $table) {
            $table->dropColumn([
                'fileBuktiKeanggotaanOrganisasiWartawan',
                'fileBuktiKeanggotaanOrganisasiPerusahaanPers',
            ]);
        });
    }
};
