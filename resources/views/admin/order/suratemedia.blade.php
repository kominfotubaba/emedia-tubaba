<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pesanan| E-Media Tulang Bawang Barat 2023</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
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
        /* -webkit-print-color-adjust: exact !important; */
    }

    @media print {
        .page {
            clear: both;
            page-break-after: always;
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
        <!-- {{-- COVER --}} -->
        <div class="page">
            <div class="py-4 px-5">
                <div class="container-fluid">
                    <!-- KOP SURAT -->
                    <div class="row text-center pb-3 border-bottom border-2 border-dark">
                        <div class="col-2 ">
                            <img class="img-fluid" style="height: 100px;"
                                src="https://tubaba.go.id/assets/img/logo%20tubaba.png" alt="">
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
                            <img class="d-flex align-items-start mt-0" style="width:80px; height:100px;"
                                src="https://emedia.tubaba.go.id/assets/img/logo/logo_kominfo_blue.png" alt"">
                        </div>
                    </div>
                    <!-- END KOP SURAT -->

                    <div class="row">
                        <div class="row">
                            <br>
                            <br>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="row">
                            <br>
                            <br>
                        </div>
                        <strong class="text-uppercase fs-5" style="line-height: 1;">
                            <div class="col-12">SURAT PESANAN (SP)</div>
                            <br>
                            <div class="col-12">(E-CATALOG)</div>
                        </strong>
                        <div class="row">
                            <br>
                            <br>
                            <br>
                        </div>
                        <div class="col-12">ANTARA</div>
                        <div class="row">
                            <br>
                            <br>
                            <br>
                        </div>
                        <strong class="text-uppercase fs-5" style="line-height: 1;">
                            <div class="col-12">DINAS KOMUNIKASI DAN INFORMATIKA</div>
                        </strong>
                        <div class="row">
                            <br>
                            <br>
                            <br>
                        </div>
                        <div class="col-12">DENGAN</div>
                        <div class="row">
                            <br>
                            <br>
                            <br>
                        </div>
                        <strong class="text-uppercase fs-5" style="line-height: 1;">
                            <div class="col-12">{{ $d->nama_media }}</div>
                            <!--NAMA MEDIA COK-->
                            <div class="col-12">{{ $d->nama_perusahaan }}</div>
                            <!--NAMA PERUSAHAAN COK-->
                        </strong>
                        <div class="row">
                            <br>
                            <br>
                            <br>
                        </div>
                        <div class="text-start">

                            <div class="row ">
                                <div class="col-3">ID PAKET</div>
                                <div class="col-9">: {{ $d->id_ekatalog }}</div>
                            </div>
                            <div class="row">
                                <div class="col-3">Kegiatan</div>
                                <div class="col-9">: -</div>
                            </div>
                            <div class="row">
                                <div class="col-3">Pekerjaan</div>
                                <div class="col-9">: -</div>
                            </div>
                            <div class="row">
                                <div class="col-3">Nomor Kontrak</div>
                                <div class="col-9">:
                                    480/{{ $d->nomor_order }}/LHM/II.15/TUBABA/{{ $d->tahun_order }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">Tanggal Kontrak</div>
                                <div class="col-9">: {{ $d->updated_at->format('d F Y') }}</div>
                            </div>
                            <div class="row">
                                <div class="col-3">Nilai</div>
                                <div class="col-9">: Rp. {{ number_format($d->total_nilai_order, 2, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <br>
                            <br>
                            <br>
                        </div>
                        <strong class="text-uppercase fs-5" style="line-height: 1;">
                            <div class="col-12">TAHUN ANGGARAN {{ $d->tahun_order }}</div>
                            <!--NAMA MEDIA COK-->
                        </strong>
                        <div class="row">
                            <br>
                            <br>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- {{-- END COVER --}} -->

        <!-- {{-- HALAMAN PERTAMA MULAI --}} -->
        <div class="page">
            <div class="py-4 px-5">
                <div class="container-fluid">

                    <!-- KOP SURAT -->
                    <div class="row text-center pb-3 border-bottom border-2 border-dark">
                        <div class="col-2 ">
                            <img class="img-fluid" style="height: 100px;"
                                src="https://tubaba.go.id/assets/img/logo%20tubaba.png" alt="">
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
                            <img class="d-flex align-items-start mt-0" style="width:80px; height:100px;"
                                src="https://emedia.tubaba.go.id/assets/img/logo/logo_kominfo_blue.png" alt"">
                        </div>
                    </div>
                    <!-- END KOP SURAT -->

                    <!-- <hr> -->

                    <div class="text-center">
                        <div class="row">
                            <br>
                            <br>
                        </div>
                        <strong class="text-uppercase fs-5" style="line-height: 1;">
                            <span>SURAT PESANAN</span>
                            <br>
                        </strong>
                    </div>
                    <div class="row border border-dark mt-3">
                        <div class="col-5 border-end border-dark">
                            <div style="margin-top: 20%;" class="row text-center text-align: justify">
                                <h6>SURAT PESANAN (SP)</h6>
                            </div>
                        </div>

                        <div class="col-7">
                            <div class="row text-align: justify">
                                <h6>SATUAN KERJA PEJABAT PENANDATANGANAN/ PENGESAHAN TANDA BUKTI PERJANJIAN;</h6>
                            </div>
                            <div class="row border-top border-dark text-align: justify">
                                <h6>NOMOR DAN TANGGAL SP ;</h6>
                                <div class="row">
                                    <div class="col-4">
                                        <h6>NOMOR</h6>
                                    </div>
                                    <div class="col-8">
                                        <H6>:
                                            480/{{ $d->nomor_order }}/LHM/II.15/TUBABA/{{ $d->tahun_order }}
                                        </H6> <!-- NOMOR SP -->
                                    </div>
                                    <div class="col-4">
                                        <h6>TANGGAL</h6> <!-- TANGGAL SP -->
                                    </div>
                                    <div class="col-8">
                                        <H6>: {{ $d->updated_at->format('d F Y') }}</H6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 border-top border-dark">
                            <p> Yang bertanda tangan dibawah ini : </p>
                        </div>

                        <div class="row">
                            <div class="col-3">Nama</div>
                            <div class="col-9"><b>: {{ $d->kpa }}</b></div>
                        </div>

                        <div class="row">
                            <div class="col-3">Jabatan</div>
                            <div class="col-9">
                                <p>: Pejabat Pembuat Komitmen </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">Alamat</div>
                            <div class="col-9">
                                <p>: Dinas Komunikasi dan Informatika, Kompleks Perkantoran Pemerintah Daerah Tulang
                                    Bawang
                                    Barat - Kabupaten Tulang Bawang Barat -
                                    Lampung </p>
                            </div>
                        </div>

                        <div class="row">
                            <p> Selanjutnya disebut sebagai <b> Pejabat Penandatangan/Pengesahan/Pihak Pertama </b>
                                Tanda
                                Bukti Perjanjian
                                ; </p>
                        </div>

                        <div class="row">
                            <div class="col-3">Nama Media</div>
                            <div class="col-9"><b>: {{ $d->nama_media }}</b></div>
                        </div>

                        <div class="row">
                            <div class="col-3">Alamat Media</div>
                            <div class="col-9">
                                <p>: {{ $d->alamat_perusahaan }} </p>
                            </div>
                            <!-- <div class="col-12">yang dalam hal ini diwakili oleh <span>:</span></div> -->
                            <!-- Nama Perwakilan cok-->
                            <p> Selanjutnya disebut sebagai <b> Penyedia/Pihak Kedua </b> : </p>
                        </div>

                        <div class="row">
                            <p> Untuk mengirimkan barang dengan memperhatikan ketentuan-ketentuan sebagai berikut : </p>
                        </div>

                        <div class="row">
                            <p> <b> Rincian Barang </b> </p>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                Daftar Produk
                            </div>
                            <div class="col-6 text-start">
                                <h6 class="m-1">
                                    PAKET ({{ $d->nama_paket }})
                                    <!-- JENIS PAKET COK-->
                                </h6>
                            </div>
                            <div class="col-3"></div>
                        </div>
                        <div class="p-2">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col-2">Nama Produk</th>
                                        <th scope="col-2 d-flex align-items-center">Kuantitas</th>
                                        <th scope="col-1">Mata Uang</th>
                                        <th scope="col-2">Harga Satuan</th>
                                        <th scope="col-1">Harga Kirim</th>
                                        <th scope="col-2">Tanggal Pengiriman Produk</th>
                                        <th scope="col-2">Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- FOREACH -->
                                    <tr>
                                        <th scope="row">
                                            <p>{{ $d->id_ekatalog }} <br> <br>{{ $d->detail_paket }}</p>
                                            <!--JENIS PAKET DAN KETERANGAN PAKET JIKA ADA-->
                                        </th>
                                        <td>{{ $d->jumlah_paket }}</td>
                                        <!--JUMLAH KLIK/JUMLAH PAKET DALAM SATU ORDERAN-->
                                        <td>IDR</td>
                                        <td>Rp. {{ number_format($d->nilai_order, 2, ',', '.') }}</td>
                                        <td>Rp.-</td>
                                        <td>{{ $d->updated_at->format('d F Y') }}</td>
                                        <td>Rp. {{ number_format($d->total_nilai_order, 2, ',', '.') }}</td>
                                    </tr>
                                    <!-- END FOREACH -->

                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <p>
                                TERBILANG : <b> <i> {{ terbilang($d->total_nilai_order) }} rupiah</i></b>
                            </p>
                        </div>

                    </div>
                </div>


            </div>
        </div>
        <!-- {{-- HALAMAN PERTAMA SELESAI --}} -->


        <!-- {{-- HALAMAN KEDUA MULAI --}} -->
        <div class="page">
            <div class="py-4 px-5">
                <div class="container-fluid border border-dark">
                    <br>

                    <div class="row">
                        <h6>
                            <b>
                                SYARAT DAN KETENTUAN:
                            </b>
                        </h6>
                    </div>
                    <div class="row">
                        <h6>
                            <!-- COK DI SINI GANTI NAMA MEDIA DAN PERUSAHAAN SESUAI ORDER -->
                            <p style="text-align: justify;">
                                Permintaan belanja iklan untuk Pemerintah Kabupaten Tulang Bawang Barat melalui
                                <b>{{ $d->nama_media }}</b>, produk pers dari <b>{{ $d->nama_perusahaan }}</b>.
                            <div class=""></div>
                            </p>
                            <p>
                                Dengan ketentuan sebagaimana tercantum dalam pasal-pasal berikut:
                            </p>
                        </h6>
                    </div>
                    <div class="row text-center">
                        <h6>
                            <b>PASAL 1</b>
                        </h6>
                    </div>
                    <div class="row text-center">
                        <h6>
                            <b>LINGKUP PEKERJAAN</b>
                        </h6>
                    </div>
                    <div class="row">
                        <h6>
                            <!-- COK DI SINI GANTI NAMA PAKET SESUAI ORDER -->
                            <p style="text-align: justify;">
                                <b>PIHAK PERTAMA</b> memberikan pekerjaan kepada <b>PIHAK KEDUA</b> dan <b>PIHAK
                                    KEDUA</b>
                                menerima dan melaksanakan pekerjaaan
                                <b>{{ $d->nama_paket }}</b> sebagaimana tercantum pada Surat Pesanan ini.
                            </p>
                        </h6>
                    </div>
                    <div class="row text-center">
                        <h6>
                            <b>PASAL 2</b>
                        </h6>
                    </div>
                    <div class="row text-center">
                        <h6>
                            <b>HARGA PEKERJAAN</b>
                        </h6>
                    </div>
                    <div class="row">
                        <h6>
                            <!-- COK DI SINI GANTI NAMA PAKET DAN HARGA SESUAI ORDER -->
                            <p style="text-align: justify;">
                                Biaya Pekerjaan/Layanan <b>{{ $d->nama_paket }}</b> sebesar
                                Rp {{ number_format($d->total_nilai_order, 2, ',', '.') }}
                                ({{ terbilang($d->total_nilai_order) }} rupiah)
                                sudah termasuk PPN 11% dengan rincian Layanan dan Harga sebagaimanan pada Surat Pesanan
                                ini.
                            </p>
                        </h6>
                    </div>
                    <div class="row text-center">
                        <h6>
                            <b>PASAL 3</b>
                        </h6>
                    </div>
                    <div class="row text-center">
                        <h6>
                            <b>CARA PEMBAYARAN</b>
                        </h6>
                    </div>
                    <div class="row">
                        <h6>
                            <!-- COK DI SINI GANTI NOMOR DAN NAMA PEMILIK REKENING -->
                            <p style="text-align: justify;">
                                Pembayaran Pekerjaan/Layanan sebagaimana tersebut dalam Pasal 2 Surat Pesanan ini
                                dilakukan
                                oleh pihak <b>PIHAK PERTAMA</b> kepada <b>PIHAK KEDUA</b> melalui bank
                                <b>{{ $d->bank }}</b>,
                                Rekening
                                Nomor: {{ $d->no_rek }}
                                atas nama <b>{{ $d->pemilik_rekening }}</b>, setelah penyedia telah mengajukan
                                tagihan/invoice.
                            </p>
                        </h6>
                    </div>
                    <div class="row text-center">
                        <h6>
                            <b>PASAL 4</b>
                        </h6>
                    </div>
                    <div class="row text-center">
                        <h6>
                            <b>DETAIL PEKERJAAN DAN PELAPORAN</b>
                        </h6>
                    </div>
                    <div class="row">
                        <h6>
                            <p class="mb-2">
                                <!-- COK DI SINI AMBIL DARI KETERANGAN ORDER -->
                                (1)
                                PIHAK KEDUA melaksanakan pekerjaan <span> {{ $d->keterangan }} </span>
                            </p>

                            <p class="mb-2" style="text-align: justify;">
                                (2) PIHAK KEDUA menyampaikan laporan pelaksanaan pekerjaan kepada PIHAK PERTAMA dalam
                                bentuk
                                <i>softcopy</i> melalui Aplikasi E-Media.
                            </p>
                            <p style="text-align: justify;">
                                (3) PIHAK PERTAMA hanya dapat melakukan pembayaran kepada PIHAK KEDUA berdasarkan
                                laporan
                                rekapitulasi
                                yang telah diverifikasi ulang oleh PIHAK PERTAMA.
                            </p>
                        </h6>
                    </div>
                    <div class="row text-center">
                        <h6>
                            <b>PASAL 5</b>
                        </h6>
                    </div>
                    <div class="row text-center">
                        <h6>
                            <b>PENYELESAIAN PERSELISIHAN</b>
                        </h6>
                    </div>
                    <div class="row">
                        <h6>
                            <p style="text-align: justify;">
                                Pejabat Penandatangan/Pengesahan Tanda Bukti Perjanjian dan penyedia berkewajiban untuk
                                berupaya sungguh-sungguh menyelesaikan secara damai semua perselisihan yang timbul dari
                                atau
                                berhubungan
                                dengan SP ini atau interpretasinya selama atau setelah pelaksanaan pekerjaan. Jika
                                perselisihan tidak dapat
                                diselesaikan secara musyawarah maka perselisihan akan diselesaikan melalui arbitrase,
                                mediasi, konsiliasi atau
                                pengadilan negeri dalam wilayah hukum Republik Indonesia.
                            </p>
                        </h6>
                    </div>
                </div>


            </div>
        </div>
        <!-- {{-- HALAMAN KEDUA SELESAI --}} -->

        <!-- {{-- HALAMAN KETIGA MULAI --}} -->
        <div class="page">
            <div class="py-4 px-5">
                <div class="container-fluid border border-dark">
                    <br>

                    <div class="row text-center">
                        <h6>
                            <b>PASAL 6</b>
                        </h6>
                    </div>
                    <div class="row text-center">
                        <h6>
                            <b>LAIN-LAIN</b>
                        </h6>
                    </div>
                    <div class="row">
                        <h6>
                            <p style="text-align: justify;">
                                Segala sesuatu yang belum diatur dalam Surat Pesanan ini atau perubahan-perubahan yang
                                dipandang perlu oleh
                                kedua belah pihak, akan diatur dalam Surat Pesanan Tambahan (Addendum) dan merupakan
                                ketentuan yang tak
                                terpisahkan dari Surat Pesanan ini.
                            </p>
                        </h6>
                    </div>
                    <div class="row text-center">
                        <h6>
                            <b>PASAL 7</b>
                        </h6>
                    </div>
                    <div class="row text-center">
                        <h6>
                            <b>PENUTUP</b>
                        </h6>
                    </div>
                    <div class="row">
                        <h6>
                            <p style="text-align: justify;">
                                Demikian Surat Pesanan ini kami buat dan ditandatangani oleh kedua belah pihak pada hari
                                dan
                                tanggal
                                diatas dan dinyatakan sah dan mengikat terhitung mulai dari hari, tanggal bulan dan
                                tahun
                                tersebut di atas.
                            </p>
                        </h6>
                    </div>
                    <div class="row">
                        <br>
                        <br>
                    </div>
                    <div class="row">
                        <h6>
                            <p style="text-align: justify;">
                                Demikian Surat Pesanan ini kami buat dan ditandatangani dalam 2 (dua) rangkap bermaterai
                                dan
                                masing-masing
                                memiliki kekuatan hukum yang sama.
                            </p>
                        </h6>
                    </div>
                    <div class="row">
                        <br>
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <h6>
                                <p class="text-center mb-2">
                                    Untuk dan atas nama
                                </p>
                                <p class="text-center mb-2">
                                    Dinas Komunikasi dan Informatika
                                </p>
                                <p class="text-center mb-2">
                                    Pejabat Pembuat Komitmen
                                </p>
                            </h6>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5">
                            <h6>
                                <p class="text-center mb-2">
                                    Untuk dan atas nama Penyedia
                                </p>
                                <p class="text-center mb-2">
                                    <span> {{ $d->nama_media }} </span>
                                    <!--NAMA MEDIA-->
                                </p>
                                <p class="text-center mb-2">
                                    <span> {{ $d->nama_perusahaan }} </span>
                                    <!--NAMA PERUSAHAAN-->
                                </p>
                            </h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-5 text-center">
                            <h6>
                                <p>
                                    <u> {{ $d->kpa }} </u>
                                    <!--NAMA PPK-->
                                </p>
                                <p>
                                    NIP. {{ $d->kpa_nip }}
                                    <!--NIP-->
                                </p>
                            </h6>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5 text-center">
                            <h6>
                                <p>
                                    <u> {{ $d->nama_biro }} </u>
                                    <!--NAMA PENANGGUNG JAWAB/BIRO-->
                                </p>
                                <p>
                                    Kepala Biro
                                    <!--JABATAN-->
                                </p>
                            </h6>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- {{-- HALAMAN KETIGA SELESAI --}} -->
    @endforeach
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <script>
        window.print();
    </script>
</body>

</html>
