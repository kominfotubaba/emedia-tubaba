@extends('panel_theme.master')
@section('content')
    <!-- ======================== banner ========================= -->
    <section class="dash-carousel">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="5000">
                    <img src="/assets/img/berita-pj-2.jpeg" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="/assets/img/berita-pj-1.jpeg" alt="...">
                </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- ================ Pilihan Konten ================== -->
    <section class="dash-pilihan">
        <div class="text-center mt-lg-5 mt-md-4 mt-3 mb-lg-3 mb-lg-4 mb-3">
            Informasi <span class="fw-bold">Data</span>
        </div>
        <div>
            <div class="row content-data">
                <div class="col-lg-3 col-md-6 col-6 mt-lg-0 mt-md-4 mt-3">
                    <a href="/data-perusahaan">
                        <div class="card text-center">
                            <div class="icon">
                                <img src="/assets/img/perusahaan.svg" alt="" />
                            </div>
                            <div class="mb-lg-2 mb-md-2 mb-1">Data Perusahaan</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mt-lg-0 mt-md-4 mt-3">
                    <a href="/data-media">
                        <div class="card text-center">
                            <div class="icon">
                                <img src="/assets/img/media.svg" alt="" />
                            </div>
                            <div class="mb-lg-2 mb-md-2 mb-1">Data Media</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mt-lg-0 mt-md-4 mt-3">
                    <a href="/data-perwakilan-media">
                        <div class="card text-center">
                            <div class="icon">
                                <img src="/assets/img/perwakilan.svg" alt="" />
                            </div>
                            <div class="mb-lg-2 mb-md-2 mb-1">Data Perwakilan</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mt-lg-0 mt-md-4 mt-3">
                    <a href="/data-verifikasi">
                        <div class="card text-center">
                            <div class="icon">
                                <img src="/assets/img/data.svg" alt="" />
                            </div>
                            <div class="mb-lg-2 mb-md-2 mb-1">Data Verifikasi</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================ Informasi Persyaratan ================= -->
    <section class="dash-informasi p-4 mt-lg-5 mt-md-4 mt-3">
        <div class="text-center head p-2 mb-lg-5 mb-md-4 mb-3">Informasi Persyaratan & Panduan Penggunaan</div>
        <div id="owl-apk" class="owl-carousel owl-theme pb-lg-4 pb-mb-4 pb-2">
            <div class="item d-flex justify-content-center">
                <a href="/assets/pengumuman/pengumuman_registrasi_emedia_sign.pdf">
                    <div class="card">
                        <img src="/assets/img/syarat-cetak.svg" alt="">
                        <button class="btn btn-sm btn-outline-maroon mt-2">Download</button>
                    </div>
                </a>
            </div>
            <div class="item d-flex justify-content-center">
                <a href="/assets/pengumuman/pengumuman_registrasi_emedia_sign.pdf">
                    <div class="card">
                        <img src="/assets/img/syarat-elektronik.svg" alt="">
                        <button class="btn btn-sm btn-outline-maroon mt-2">Download</button>
                    </div>
                </a>
            </div>
            <div class="item d-flex justify-content-center">
                <a href="/assets/pengumuman/pengumuman_registrasi_emedia_sign.pdf">
                    <div class="card">
                        <img src="/assets/img/syarat-siber.svg" alt="">
                        <button class="btn btn-sm btn-outline-maroon mt-2">Download</button>
                    </div>
                </a>
            </div>
            <div class="item d-flex justify-content-center">
                <a href="/assets/pengumuman/Manual_Book_Pendaftaran_Emedia.pdf">
                    <div class="card">
                        <img src="/assets/img/manual-book.svg" alt="">
                        <button class="btn btn-sm btn-outline-maroon mt-2">Download</button>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection
