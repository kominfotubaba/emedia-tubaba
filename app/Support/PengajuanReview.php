<?php

namespace App\Support;

class PengajuanReview
{
    public static function fields($record): array
    {
        $fields = [
            'namaMedia' => 'Nama Media', 'namaPerusahaan' => 'Nama Perusahaan Pers',
            'nibPerusahaan' => 'No. NIB', 'kumhamPerusahaan' => 'No. AHU', 'npwpPerusahaan' => 'NPWP',
            'verifikasiDewanPers' => 'Status Perusahaan Pers', 'noKlbi' => 'KBLI',
            'namaPimred' => 'Nama Pimpinan Redaksi', 'namaPimprus' => 'Nama Pimpinan Perusahaan',
            'serfikatUkwPimred' => 'No. Sertifikat Kompetensi Pimred', 'jenisSerfikatUkwPimred' => 'Kompetensi Pimred',
            'alamatPerusahaan' => 'Alamat Perusahaan', 'alamatKecPerusahaan' => 'Kecamatan Perusahaan',
            'alamatKabPerusahaan' => 'Kabupaten/Kota Perusahaan', 'alamatProvPerusahaan' => 'Provinsi Perusahaan',
            'tlpnPerusahaan' => 'Telepon Redaksi', 'emailPerusahaan' => 'Email Redaksi',
            'namaPerwakilan' => 'Nama Perwakilan', 'alamatKecPerwakilan' => 'Kecamatan Perwakilan',
            'alamatKabPerwakilan' => 'Kabupaten/Kota Perwakilan', 'alamatProvPerwakilan' => 'Provinsi Perwakilan',
            'npwpPerwakilan' => 'NPWP Perwakilan',
            'fileNibPerusahaan' => 'Dokumen NIB', 'fileKumhamPerusahaan' => 'Dokumen AHU',
            'fileNpwpPerusahaan' => 'Dokumen NPWP Perusahaan', 'fileSerfikatUkwPimred' => 'Dokumen Kompetensi Pimred',
            'fileSuratKeteranganWartawan' => 'Surat Keterangan Wartawan', 'fileNpwpPerwakilan' => 'Dokumen NPWP Perwakilan',
        ];
        if ($record->jenis_media === 'elektronik') {
            $fields += ['jenisJangkauanSiarMediaElektronik' => 'Jenis Siaran Elektronik', 'izinIpp' => 'No. IPP', 'fileIzinIpp' => 'Dokumen IPP'];
        }
        if ($record->jenis_media === 'cetak') {
            $fields += ['namaPercetakan' => 'Nama Percetakan', 'alamatPercetakan' => 'Alamat Percetakan'];
        }
        if ($record->jenisSerfikatUkwPimred === 'madya') {
            $fields['fileSuratPernyataanPimred'] = 'Surat Pernyataan Pimred';
        }
        foreach (['organisasiWartawan', 'organisasiPerusahaanPers'] as $key) {
            if ($record->$key === 'lainnya') $fields[$key.'Lainnya'] = 'Organisasi Lainnya';
        }
        return $fields;
    }

    public static function reviews($record): array
    {
        return json_decode($record->field_reviews ?? '{}', true) ?: [];
    }

    public static function complete($record): bool
    {
        $reviews = self::reviews($record);
        foreach (self::fields($record) as $key => $label) {
            if (empty($reviews[$key]['verified']) || ($reviews[$key]['value'] ?? null) !== (string) $record->$key) return false;
        }
        return true;
    }
}
