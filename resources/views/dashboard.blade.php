@extends('panel.master')
@section('content')
    <main>
        <div class="container">
            <!-- Title and Top Buttons Start -->
            <div class="page-title-container">
                <div class="row">
                    <!-- Title Start -->
                    <div class="col-12 col-md-7">
                        <h1 class="mb-0 pb-0 display-4" id="title">Dashboard</h1>
                        <!-- <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                                                                            <ul class="breadcrumb pt-0">
                                                                            <li class="breadcrumb-item"><a href="Dashboards.Default.html">Home</a></li>
                                                                            <li class="breadcrumb-item"><a href="Interface.html">Interface</a></li>
                                                                            <li class="breadcrumb-item"><a href="Interface.Content.html">Content</a></li>
                                                                            <li class="breadcrumb-item"><a href="Interface.Content.Menu.html">Menu</a></li>
                                                                            </ul>
                                                                        </nav> -->
                    </div>
                    <!-- Title End -->
                </div>
            </div>
            <!-- Title and Top Buttons End -->

            <!-- Content Start -->
            {{-- <div class="card mb-2">
                <div class="card-body h-100">Pengajuan belum dibuka, info lebih lanjut silahkan hubungi
                    kominfo@tubaba.go.id</div>
            </div> --}}
            <div class="card mb-5">
                <div class="card-body h-100">
                    {{-- Pendaftaran e-media dibuka. Registrasi mulai dari tanggal 17 s/d 29 November 2022.
                    Evaluasi Tanggal 1 s/d 19 Desember 2022. Perbaikan Berkas Pada Tanggal 21 s/d 23 Desember 2022.
                    Lengkapi berkas anda! --}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card mb-5">
                        <h5 class="card-header">Berkas Persyaratan</h5>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <li>Unduh persyaratan <a href="assets/contoh/PERSYARATAN MEDIA CETAK.pdf">Media
                                        Cetak/Harian</a></li>
                                <li>Unduh persyaratan <a href="assets/contoh/PERSYARATAN MEDIA ELEKTRONIK.pdf">
                                        Media Elektronik</a></li>
                                <li>Unduh persyaratan <a href="assets/contoh/PERSYARATAN MEDIA SIBER.pdf">Media
                                        Siber</a></li>


                                <p class="mt-4">Peringatan!</p>
                                <p>Segala bentuk pemalsuan berkas persyaratan pendaftaran
                                    pada aplikasi E-Media Dinas Komunikasi dan Informatika
                                    tidak bertanggung jawab dan akan di proses sesuai hukum
                                    yang berlaku.</p>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card mb-5">
                        <h5 class="card-header">Bantuan</h5>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <li>Unduh<a href="assets/contoh/Manual Book Pendaftaran E Media-NG.pdf">
                                        Manual Book</a></li>
                                <li>Unduh <a href="assets/contoh/Format Surat Pernyataan.doc">Format Surat Pernyataan
                                    </a>
                                </li>
                                <li>Unduh <a href="assets/contoh/Surat_Pernyataan_Media.pdf">Contoh Surat Pernyataan
                                    </a>
                                </li>
                                <li> Hubungi <a href="">kominfo@tubaba.go.id</a> jika terdapat
                                    pertanyaan ataupun kendala dalam
                                    penggunaan
                                    E-Media</li>
                            </blockquote>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Content End -->
        </div>
    </main>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div id="pemberitahuan" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-dialog-centered">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pemberitahuan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#pemberitahuan').modal('show')
        });
    </script>
@endpush
