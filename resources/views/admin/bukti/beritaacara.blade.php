<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara | E-Media Tulang Bawang Barat 2023</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300&display=swap" rel="stylesheet">
</head>
<style>
    .page {
        width: 22cm;
        /* height: 33cm; */
        /* box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px; */
        -webkit-print-color-adjust: exact !important;
    }

    @media print {
        @page {
            /* size: portrait */
        }

        .page {
            clear: both;
            page-break-after: always;
            display: block;
        }

        footer {
            font-family: 'Comic Neue', cursive;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    }

    .col-print-1 {
        width: 8%;
        float: left;
    }

    .col-print-2 {
        width: 16%;
        float: left;
    }

    .col-print-3 {
        width: 25%;
        float: left;
    }

    .col-print-4 {
        width: 33%;
        float: left;
    }

    .col-print-5 {
        width: 42%;
        float: left;
    }

    .col-print-6 {
        width: 50%;
        float: left;
    }

    .col-print-7 {
        width: 58%;
        float: left;
    }

    .col-print-8 {
        width: 66%;
        float: left;
    }

    .col-print-9 {
        width: 75%;
        float: left;
    }

    .col-print-10 {
        width: 83%;
        float: left;
    }

    .col-print-11 {
        width: 92%;
        float: left;
    }

    .col-print-12 {
        width: 100%;
        float: left;
    }
</style>

<body>
    @php
        function penyebut($nilai)
        {
            $nilai = abs($nilai);
            $huruf = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
            $temp = '';
            if ($nilai < 12) {
                $temp = ' ' . $huruf[$nilai];
            } elseif ($nilai < 20) {
                $temp = penyebut($nilai - 10) . ' belas';
            } elseif ($nilai < 100) {
                $temp = penyebut($nilai / 10) . ' puluh' . penyebut($nilai % 10);
            } elseif ($nilai < 200) {
                $temp = ' seratus' . penyebut($nilai - 100);
            } elseif ($nilai < 1000) {
                $temp = penyebut($nilai / 100) . ' ratus' . penyebut($nilai % 100);
            } elseif ($nilai < 2000) {
                $temp = ' seribu' . penyebut($nilai - 1000);
            } elseif ($nilai < 1000000) {
                $temp = penyebut($nilai / 1000) . ' ribu' . penyebut($nilai % 1000);
            } elseif ($nilai < 1000000000) {
                $temp = penyebut($nilai / 1000000) . ' juta' . penyebut($nilai % 1000000);
            } elseif ($nilai < 1000000000000) {
                $temp = penyebut($nilai / 1000000000) . ' milyar' . penyebut(fmod($nilai, 1000000000));
            } elseif ($nilai < 1000000000000000) {
                $temp = penyebut($nilai / 1000000000000) . ' trilyun' . penyebut(fmod($nilai, 1000000000000));
            }
            return $temp;
        }

        function terbilang($nilai)
        {
            if ($nilai < 0) {
                $hasil = 'minus ' . trim(penyebut($nilai));
            } else {
                $hasil = trim(penyebut($nilai));
            }
            return $hasil;
        }
    @endphp
    @foreach ($data as $d)
        {{-- HALAMAN PERTAMA MULAI --}}
        <div class="page">
            <div class="py-4 px-5">
                <div class="container-fluid">
                    <div class="row text-center ">
                        <div class="col-2 ">
                            <img class="img-fluid" style="height: 100px;" src="https://tubaba.go.id/assets/img/logo%20tubaba.png" alt="">
                        </div>
                        <div class="col-8">
                            <strong class="text-uppercase fs-6" style="line-height: 1;">
                                <p>PEMERINTAH KABUPATEN TULANG BAWANG BARAT</p>
                            </strong>
                            <strong class="text-uppercase fs-4" style="line-height: 1;">
                                <p> DINAS KOMUNIKASI DAN INFORMATIKA </p>
                            </strong>
                            <p style="font-size: 10pt; line-height: 1;"> Alamat: Komplek Perkantoran Pemerintah
                                Kabupaten
                                Tulang Bawang Barat </p>
                        </div>
                        <div class="col-2 mt-0">
                            <img class="d-flex align-items-start mt-0" style="width:80px; height:100px;" src="https://emedia.tubaba.go.id/assets/img/logo/logo_kominfo_blue.png" alt"">
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <div class="row">
                            <br>
                        </div>
                        <strong class="text-uppercase fs-5" style="line-height: 1;">
                            <u>berita acara pemeriksaan barang</u>
                        </strong>
                        <p class="text-capitalize fs-5" style="line-height: 1;">
                            Nomor :
                            480/{{ $d->nomor_order }}/LHM/II.15/TUBABA/{{ $d->tahun_order }}
                        </p>
                    </div>

                    <p class="px-5 fs-6" style="text-align: justify;">
                        Pada hari ini , Tanggal
                        {{ $d->updated_at->format('d') }}, Bulan {{ $d->updated_at->format('m') }},
                        Tahun {{ $d->updated_at->format('Y') }}, kami yang bertanda
                        tangan dibawah
                        ini telah memeriksa barang (terlampir) sebagai berikut :
                    </p>
                    <div class="px-5">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-capitalize" style="text-align: center;  vertical-align: middle;">
                                    <th class="col-md-7 ">
                                        <span>
                                            Keterangan
                                        </span>
                                    </th>
                                    <th class="col-md-2">
                                        <span>
                                            Nama Paket
                                        </span>
                                    </th>
                                    <th class="col-md-2">
                                        <span>
                                            Jumlah Paket
                                        </span>
                                    </th>
                                    <th class="col-md-2">
                                        <span>
                                            Harga Satuan
                                        </span>
                                    </th>
                                    <th class="col-md-3 ">
                                        <span>
                                            Harga keseluruhan paket (Rp)
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-top-0">
                                    <td class=" text-elipsis">{{ $d->keterangan }}</td>
                                    <td style=" vertical-align: middle; text-align: center;">
                                        {{ $d->detail_paket }}</td>
                                    <td rowspan="" style=" vertical-align: middle; text-align: center;">
                                        {{ $d->jumlah_paket }} </td>
                                    <td rowspan="" style=" vertical-align: middle; text-align: center;">
                                        {{ number_format($d->nilai_order, 0, ',') }}</td>
                                    <td rowspan="" style=" vertical-align: middle; text-align: center;">Rp.
                                        {{ number_format($d->total_nilai_order, 0, ',') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style=" vertical-align: middle; text-align: center;">JUMLAH
                                    </td>
                                    <td style=" vertical-align: middle; text-align: center;">
                                        Rp. {{ number_format($d->total_nilai_order, 0, ',') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <br> -->
                        <br><br>
                        <div class="card border-0">
                            <div class="row">
                                <p style="text-align: justify;">
                                    Demikian Berita Acara ini dibuat dengan sebenarnya, untuk dapat
                                    dipergunakan sebagaimana mestinya.
                                </p>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-print-4">

                                </div>
                                <div class="col-print-2">

                                </div>
                                <div class="col-print-6">
                                    <p class="text-capitalize" style="text-align: center;">
                                        pengelola barang
                                    </p>
                                    <img style="max-width: 250px; max-height:200px;" src="" class="img-thumbnail border-0 p-0 m-0" alt="">
                                    <br>
                                    <br>
                                    <br>
                                    <p class="text-center text-uppercase">
                                        <strong>
                                            <u>
                                                {{ $d->pengelola_barang }}
                                            </u>
                                        </strong>
                                        <br>
                                        <strong>
                                            NIP. {{ $d->pengelola_barang_nip }}
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- HALAMAN PERTAMA SELESAI --}}


        {{-- // HALAMAN KEDUA MULAI --}}
        <div class="page">
            <div class="container-fluid py-4 px-5">
                <div class="row text-center ">
                    <div class="col-2 ">
                        <img class="img-fluid" style="height: 100px;" src="https://tubaba.go.id/assets/img/logo%20tubaba.png" alt="">
                    </div>
                    <div class="col-8">
                        <strong class="text-uppercase fs-6" style="line-height: 1;">
                            <p>PEMERINTAH KABUPATEN TULANG BAWANG BARAT</p>
                        </strong>
                        <strong class="text-uppercase fs-4" style="line-height: 1;">
                            <p> DINAS KOMUNIKASI DAN INFORMATIKA </p>
                        </strong>
                        <p style="font-size: 10pt; line-height: 1;"> Alamat: Komplek Perkantoran Pemerintah Kabupaten
                            Tulang Bawang Barat </p>
                    </div>
                    <div class="col-2 mt-0">
                        <img class="d-flex align-items-start mt-0" style="width:80px; height:100px;" src="https://emedia.tubaba.go.id/assets/img/logo/logo_kominfo_blue.png" alt"">
                    </div>
                </div>
                <hr>
                <br>
                <div class="text-center">
                    <strong class="text-uppercase fs-5" style="line-height: 1;">
                        <u>BERITA ACARA PENERIMAAN BARANG</u>
                    </strong>
                    <p class="text-capitalize fs-5" style="line-height: 1;">
                        Nomor :480/{{ $d->nomor_order }}/LHM/II.15/TUBABA/{{ $d->tahun_order }}
                    </p>
                </div>
                <p class="px-5 fs-6" style="text-align: justify;">
                    Pada hari ini , Tanggal {{ $d->updated_at->format('d') }}, Bulan
                    {{ $d->updated_at->format('m') }},
                    Tahun {{ $d->updated_at->format('Y') }}, kami yang bertanda tangan dibawah
                    ini :
                </p>
                <div class="px-5 mx-5">
                    <table class="table table-borderless">
                        <thead>
                            <tr class="lh-1">
                                <td class="col-print-1">1.</td>
                                <td class="col-print-2">Nama</td>
                                <td class="col-print-1">:</td>
                                <th class="col-print-8">
                                    <strong>
                                        {{ $d->nama_biro }}
                                    </strong>
                                </th>
                            </tr>
                            <tr class="lh-1">
                                <td class="col-print-1"></td>
                                <td class="col-print-2">Alamat Perusahaan</td>
                                <td class="col-print-1">:</td>
                                <td class="col-print-8">
                                    {{ $d->alamat_perusahaan }}
                                </td>
                            </tr>
                            <tr class="lh-1">
                                <td class="col-print-1 "></td>
                                <td class="col-print-8">Selanjutnya disebut <strong><u>PIHAK KESATU</u></strong></td>
                                <td class="col-print-1"></td>
                                <th class="col-print-2"></th>
                            </tr>
                            </tbody>
                    </table>
                </div>
                <div class="px-5 mx-5">
                    <table class="table table-borderless">
                        <thead>
                            <tr class="lh-1">
                                <td class="col-print-1">2.</td>
                                <td class="col-print-2">Nama</td>
                                <td class="col-print-1">:</td>
                                <th class="col-print-8">
                                    <strong>
                                        {{ $d->pengelola_barang }}
                                    </strong>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="lh-1">
                                <td class="col-print-1"></td>
                                <td class="col-print-2">Jabatan</td>
                                <td class="col-print-1">:</td>
                                <td class="col-print-8">Pengelola Barang pada Dinas Komunikasi dan Informatika
                                    Tulang Bawang Barat
                                </td>
                            </tr>
                            <tr class="lh-1">
                                <td class="col-print-1"></td>
                                <td class="col-print-2">Alamat Perusahaan</td>
                                <td class="col-print-1">:</td>
                                <td class="col-print-8">
                                    Jl. Jend. Sudirman Komplek Perkantoran Pemerintah Daerah
                                    Kabupaten Tulang Bawang Barat.
                                </td>
                            </tr>
                            <tr class="lh-1">
                                <td class="col-print-1"></td>
                                <td class="col-print-2"></td>
                                <td class="col-print-1"></td>
                                <td class="col-print-8">
                                    Selanjutnya disebut
                                    <strong>
                                        <u> PIHAK KEDUA</u>
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-5">
                    <p style="text-align: justify;">
                        Berdasarkan surat Perintah Kerja, Nomor : 480
                        /{{ $d->nomor_order }}/LHM/II.15/TUBABA/{{ $d->tahun_order }},
                        terlampir Pihak
                        Pertama telah
                        menyerahkan kepada Pihak
                        Kedua Barang tersebut sesuai dengan nota penyerahan barang.
                    </p>
                </div>
                <div class="px-5">
                    <p style="text-align: justify;">
                        Demikian berita acara ini dibuat dengan sebenarnya untuk dapat
                        dipergunakan sebagaimana mestinya.
                    </p>
                </div>
                <div class="px-5">
                    <div class="row">
                        <div class="col-print-6">
                            <div class="card border-0">
                                <div class="card-body text-center">
                                    <p class="text-center lh-sm">
                                        Yang Menerima
                                        <br>
                                        Pengelola Barang,
                                        <br>
                                        <a href="#" class="link-light"></a>
                                    </p>
                                    <div class="">
                                        <img style="max-width: 200px; max-height: 90px;" src="" class="img-thumbnail border-0" alt="">
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                    <p class="text-center text-uppercase">
                                        <strong>
                                            <u>
                                                {{ $d->pengelola_barang }}
                                            </u>
                                        </strong>
                                        <br>
                                        <strong>
                                            NIP. {{ $d->pengelola_barang_nip }}
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-print-6">
                            <div class="card border-0">
                                <div class="card-body text-center">
                                    <p class="text-center  lh-sm">
                                        Yang Menyerahkan,
                                        <br>
                                        Kabiro,
                                        <br>
                                    </p>
                                    <div class="">
                                        <!-- <img style="max-width: 150px; max-height: 100px;" src="" class="img-thumbnail border-0" alt=""> -->
                                        <br><br><br>
                                    </div>
                                    <p class="text-center text-uppercase">
                                        <strong>
                                            <u>
                                                {{ $d->nama_biro }}
                                            </u>
                                        </strong>
                                        <br>
                                        <strong>
                                            {{ $d->nama_media }}
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row p-0 m-0">
                        <div class="col-print-2"></div>
                        <div class="col-print-8">
                            <div class="card border-0">
                                <div class="card-body text-center">
                                    <p class="text-center">
                                        PEJABAT PELAKSANA TEKNIS KEGIATAN
                                    </p>
                                    <br>
                                    <br>
                                    <div class="">
                                        <img style="max-width: 200px; max-height: 90px;" src="" class="img-thumbnail border-0" alt="">
                                        <!-- <br><br><br><br> -->
                                    </div>
                                    <p class="text-center text-uppercase">
                                        <strong>
                                            <u>
                                                {{ $d->pptk }}
                                            </u>
                                        </strong>
                                        <br>
                                        <strong>
                                            NIP. {{ $d->pptk_nip }}
                                        </strong>
                                    </p>
                                </div>
                            </div>
                            <div class="col-print-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- //HALAMAN KEDUA SELESAI --}}


        {{-- // HALAMAN KETIGA MULAI // --}}
        <div class="page">
            <div class="container-fluid py-4 px-5">
                <div class="row text-center ">
                    <div class="col-2 ">
                        <img class="img-fluid" style="height: 100px;" src="https://tubaba.go.id/assets/img/logo%20tubaba.png" alt="">
                    </div>
                    <div class="col-8">
                        <strong class="text-uppercase fs-6" style="line-height: 1;">
                            <p>PEMERINTAH KABUPATEN TULANG BAWANG BARAT</p>
                        </strong>
                        <strong class="text-uppercase fs-4" style="line-height: 1;">
                            <p> DINAS KOMUNIKASI DAN INFORMATIKA </p>
                        </strong>
                        <p style="font-size: 10pt; line-height: 1;"> Alamat: Komplek Perkantoran Pemerintah Kabupaten
                            Tulang Bawang Barat </p>
                    </div>
                    <div class="col-2 mt-0">
                        <img class="d-flex align-items-start mt-0" style="width:80px; height:100px;" src="https://emedia.tubaba.go.id/assets/img/logo/logo_kominfo_blue.png" alt"">
                    </div>
                </div>
                <hr>
                <br>
                <div class="text-center">
                    <br>
                    <strong class="text-uppercase fs-5" style="line-height: 1;">
                        <u>BERITA ACARA PEMBAYARAN</u>
                    </strong>
                    <p class="text-capitalize fs-5" style="line-height: 1;">
                        Nomor :
                        480/{{ $d->nomor_order }}/LHM/II.15/TUBABA/{{ $d->tahun_order }}
                    </p>
                </div>
                <br>
                <p class="px-4 fs-6" style="text-align: justify;">
                    Pada hari ini Tanggal {{ $d->updated_at->format('d') }}, Bulan
                    {{ $d->updated_at->format('m') }},
                    Tahun {{ $d->updated_at->format('Y') }}, Kami yang
                    bertanda
                    tangan dibawah ini :
                </p>
                <div class="px-4 mx-5">
                    <table class="table table-borderless">
                        <thead>
                            <tr class="lh-1">
                                <td class="col-print-1 ">1.</td>
                                <td class="col-print-2">Nama</td>
                                <td class="col-print-1">:</td>
                                <th class="col-print-8">
                                    <strong>
                                        {{ $d->kpa }}
                                    </strong>
                                </th>
                            </tr>
                            <tr class="lh-1">
                                <td class="col-print-1"></td>
                                <td class="col-print-2">Jabatan</td>
                                <td class="col-print-1">:</td>
                                <td class="col-print-8">Kuasa Pengguna Anggaran
                                </td>
                            </tr>
                            <tr class="lh-1">
                                <th class="col-print-1"></th>
                                <td class="col-print-2">Alamat Kantor</td>
                                <td class="col-print-1">:</td>
                                <td class="col-print-8">
                                    Jl. Jend. Sudirman Komplek Perkantoran Pemerintah Daerah
                                    Kabupaten Tulang Bawang Barat.
                                </td>
                            </tr>
                            <tr class="lh-1">
                                <td class="col-print-1 "></td>
                                <td class="col-print-8">Selanjutnya disebut <strong><u>Pihak Pertama</u></strong>
                                </td>
                                <td class="col-print-1"></td>
                                <th class="col-print-2"></th>
                            </tr>
                            </tbody>
                    </table>
                    <p> </p>
                </div>
                <div class="px-4 mx-5">
                    <table class="table table-borderless">
                        <thead>
                            <tr class="lh-1">
                                <td class="col-print-1">2.</td>
                                <td class="col-print-2">Nama</td>
                                <td class="col-print-1">:</td>
                                <th class="col-print-8">
                                    <strong>
                                        {{ $d->nama_biro }}
                                    </strong>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="lh-1">
                                <td class="col-print-1"></td>
                                <td class="col-print-2">Jabatan</td>
                                <td class="col-print-1">:</td>
                                <td class="col-print-8">Kabiro {{ $d->nama_media }}
                                </td>
                            </tr>
                            <tr class="lh-1">
                                <th class="col-print-1"></th>
                                <td class="col-print-2">Alamat Perusahaan</td>
                                <td class="col-print-1">:</td>
                                <td class="col-print-8">
                                    {{ $d->alamat_perusahaan }}
                                </td>
                            </tr>
                            <tr class="lh-1">
                                <td class="col-print-1 "></td>
                                <td class="col-print-8">Selanjutnya disebut <strong><u>Pihak Kedua</u></strong></td>
                                <td class="col-print-1"></td>
                                <th class="col-print-2"></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="px-4">
                    <p style="text-align: justify;"><strong>Pihak Pertama</strong> atas nama Kuasa Pengguna Anggaran
                        Dinas
                        Komunikasi dan Informatika Tulang Bawang Barat telah melakukan pembayaran Kepada
                        <strong>Pihak Kedua</strong> berupa Uang Pengganti dalam bentuk transfer atas pekerjaan
                        belanja
                        ADVETORIAL/ PUBLIKASI BERITA atas nama <strong>{{ $d->nama_biro }}</strong> selaku
                        <strong> {{ $d->nama_media }} </strong> Berdasarkan Berita Acara Pemeriksaan dan Berita Acara
                        Penerimaan Barang (terlampir), sejumlah Rp.
                        {{ number_format($d->total_nilai_order, 2, ',', '.') }},- dengan
                        <strong> LUNAS </strong>
                    </p>
                </div>
                <div class="px-4">
                    <p style="text-align: justify;">Demikian Berita Acara ini dibuat rangkap 2 (dua) untuk dapat
                        dipergunakan sebagaimana mestinya.</p>
                </div>

                <div class="container-fluid px-5">
                    <div class="row">
                        <div class="col-print-5">
                            <div class="card border-0">
                                <div class="card-body text-center">
                                    <p class="text-center">
                                        <strong>
                                            PIHAK KEDUA
                                        </strong>
                                        <br>
                                        KABIRO,
                                        <br>
                                        MEDIA
                                    </p>
                                    <div class="">
                                        <!-- <img style="max-width: 200px; max-height: 200px;" src="" class="img-thumbnail border-0" alt=""> -->
                                        <br><br><br><br>

                                    </div>
                                    <p class="text-center text-uppercase">
                                        <strong>
                                            <u>
                                                {{ $d->nama_biro }}
                                            </u>
                                        </strong>
                                        <br>
                                        {{ $d->nama_media }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-print-1">
                        </div>
                        <div class="col-print-6">
                            <div class="card border-0">
                                <div class="card-body text-center">
                                    <p class="text-center">
                                        <span>Panaragan,</span>
                                        <br>
                                        <strong>
                                            PIHAK KESATU
                                        </strong>
                                        <br>
                                        Kuasa Pengguna Anggaran,
                                    </p>
                                    <div class="">
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <!--<img style="max-width: 200px; max-height: 100px;" src="" class="img-thumbnail border-0" alt="">-->
                                    </div>
                                    <p class="text-center text-uppercase">
                                        <strong>
                                            <u>
                                                {{ $d->kpa }}
                                            </u>
                                        </strong>
                                        <br>
                                        NIP. {{ $d->kpa_nip }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- // HALAMAN KETIGA SELESAI  --}}

        {{-- // HALAMAN KEEMPAT MULAI --}}
        <div class="page">
            <div class="container-fluid px-5 py-4">
                <div class="row p-0">
                    <div class="col-2 d-flex flex-column justify-content-center border-top border-start border-bottom border-dark">
                        <img class="img-thumbnail border-0" src="https://tubaba.go.id/assets/img/logo%20tubaba.png" alt="">
                    </div>

                    <div class="col-10 border border-dark p-0">
                        <div class="col-12 text-center border-bottom border-dark p-0 py-2">
                            <strong>
                                PEMERINTAHAN KABUPATEN TULANG BAWANG BARAT
                                <br>
                                SURAT BUKTI PENGELUARAN / BELANJA
                            </strong>
                        </div>
                        <div class="col-12 py-3 px-4 ">
                            <div class="row ">
                                <div class="col-2">Nomor</div>
                                <div class="col-1"> <strong>:</strong></div>
                                <div class="col-9"> Nomor :
                                    480/{{ $d->nomor_order }}/LHM/II.15/TUBABA/{{ $d->tahun_order }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">Tanggal</div>
                                <div class="col-1"> <strong>:</strong></div>
                                <div class="col-9">{{ $d->updated_at->format('d F Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row border-top-0 border border-dark">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-2">Urusan Pemerintahan</div>
                            <div class="col-1">:</div>
                            <div class="col-1">2.16</div>
                            <div class="col-8">URUSAN PEMERINTAHAN WAJIB YANG TIDAK BERKAITAN DENGAN PELAYANAN DASAR
                                KOMUNIKASI DAN INFORMATIKA</div>
                        </div>
                        <div class="row">
                            <div class="col-2">Unit Organisasi</div>
                            <div class="col-1">:</div>
                            <div class="col-3">2.16.2.20.2.21.04.0000</div>
                            <div class="col-6">Dinas Komunikasi dan Informatika</div>
                        </div>
                        <div class="row">
                            <div class="col-2">Sub Unit Organisasi</div>
                            <div class="col-1">:</div>
                            <div class="col-3">2.16.2.20.2.21.04.0000</div>
                            <div class="col-6">Dinas Komunikasi dan Informatika</div>
                        </div>

                    </div>
                </div>
                <div class="row border-top-0 border border-dark">
                    <p>Sudah diterima dari Bendahara Pengeluaran, uang sejumlah <strong>Rp.
                            {{ number_format($d->total_nilai_order, 2, ',', '.') }},-
                        </strong>

                        <br> Terbilang : <i>({{ terbilang($d->total_nilai_order) }} rupiah)</i>
                    </p>
                </div>
                <div class="row border-top-0 border border-dark">
                    <p>
                        <strong>
                            Yaitu untuk pembayaran :
                        </strong>
                    </p>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-2">Program</div>
                            <div class="col-1">:</div>
                            <div class="col-1">02</div>
                            <div class="col-8">Program Pengelolaan Informasi Dan Komunikasi Publik</div>
                        </div>
                        <div class="row">
                            <div class="col-2">Kegiatan</div>
                            <div class="col-1">:</div>
                            <div class="col-1">2.01</div>
                            <div class="col-8">Pengelolaan Informasi dan Komunikasi Publik Pemerintah Daerah
                                Kabupaten/Kota
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">Sub Kegiatan</div>
                            <div class="col-1">:</div>
                            <div class="col-1">07</div>
                            <div class="col-8">Layanan Hubungan Media
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">Kode Rekening</div>
                            <div class="col-1">:</div>
                            <div class="col-2">5.1.02.02.01.0055</div>
                            <div class="col-7">Belanja Jasa Iklan/Reklame, Film dan Pemotretan
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">Untuk Keperluan</div>
                            <div class="col-1">:</div>
                            <div class="col-9">BELANJA JASA IKLAN/PUBLIKASI BERITA</div>
                        </div>
                    </div>
                </div>
                <div class="row border-top-0 border border-dark">
                    <div class="col-6 border-top-0 border border-dark">
                        <p>
                            <strong>
                                Yang berhak menerima pembayaran :
                            </strong>
                        </p>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2">Nama</div>
                                <div class="col-1">:</div>
                                <div class="col-9"></div>
                            </div>
                            <div class="row">
                                <div class="col-2">Alamat</div>
                                <div class="col-1">:</div>
                                <div class="col-9"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <p>
                            <strong>
                                Informasi Potongan Pajak
                            </strong>
                        </p>
                        <div class="col-12">
                            @php
                                $n = str_replace('.', '', $d->total_nilai_order);
                                $ps23 = ($n * 2) / 100;
                                $hasil = $ps23;
                                $tps23 = number_format($ps23, 0, ',', '.');
                                $thasil = number_format($hasil, 0, ',', '.');
                            @endphp
                            <div class="row">
                                <div class="col-1">-</div>
                                <div class="col-6">Pajak Penghasilan Ps 23</div>
                                <div class="col-5">Rp. {{ $tps23 }},- </div>
                            </div>

                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-4"></div>
                                <div class="col-2">Jumlah</div>
                                <div class="col-5 border-0 border-top border border-dark">Rp. {{ $thasil }},-
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row border-top-0 border border-dark">
                    <div class="col-4 border-top-0 border border-dark">
                        <p class="text-center">
                            Yang menerima barang
                            <br>
                            memeriksa pekerjaan tersebut diatas
                        </p>
                        <br>
                        <br>
                        <br>
                        <p class="col-12 text-center lh-1">
                        </p>
                        <p class="col-12 border-0 border-top text-center border border-dark">
                        </p>
                    </div>
                    <div class="col-4 border-top-0 border border-dark">
                        <p class="text-center">

                            <br>
                            BENDAHARA PENGELUARAN
                        </p>
                        <br>
                        <br>
                        <br>
                        <br>
                        <p class="col-12 text-center lh-1">
                            {{ $d->bendahara }}
                        </p>
                        <p class="col-12 border-0 border-top text-center border border-dark">
                            NIP. {{ $d->bendahara_nip }}
                        </p>

                    </div>
                    <div class="col-4 ">
                        <p class="text-center">
                            PANARAGAN,
                            <br>
                            Kuasa Pengguna Anggaran
                        </p>
                        <br>
                        <br>
                        <br>
                        <br>
                        <p class="col-12 text-center lh-1">
                            {{ $d->kpa }}
                        </p>
                        <p class="col-12 border-0 border-top text-center border border-dark">
                            NIP. {{ $d->kpa_nip }}
                        </p>
                    </div>
                </div>
            </div>
            <footer>
                <p>
                    Printed Dokumen By E-media/{{ date('Y') }}
                </p>
            </footer>
        </div>
    @endforeach
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
    // window.print();
</script>

</html>
