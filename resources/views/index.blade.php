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

    <section class="container mt-5">
        <div class="text-center fs-1 mb-5">
            Data <span class="fw-bold">Informasi</span>
        </div>

        <div class="row">
            <div class="col-4">
                <a class="text-decoration-none" href="/data-perusahaan">
                    <div class="card">
                        <div style="color: var(--maroon);" class="card-body fs-1 text-center">
                            <i class="bi bi-file-earmark-fill"></i>
                            <div class="d-flex fs-4 justify-content-center">
                                Data Perusahaan
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a class="text-decoration-none" href="/data-media">

                    <div class="card">
                        <div style="color: var(--maroon);" class="card-body fs-1 text-center">
                            <i class="bi bi-file-earmark-font-fill"></i>
                            <div class="fs-4 d-flex justify-content-center">
                                Data Media
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a class="text-decoration-none" href="/data-perwakilan-media">

                    <div class="card">
                        <div style="color: var(--maroon);" class="card-body fs-1 text-center">
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <div class="fs-4 d-flex justify-content-center">
                                Data Perwakilan
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- ================ Berita Terbaru Tubaba ================== -->
    {{-- <section class="berita-terbaru">
        <div class="judul-atas ps-2 ps-md-3 ps-lg-5 pe-2 pe-md-3 pe-lg-5 pt-1 pt-md-1 pt-lg-2 mb-2 mb-md-0 mb-lg-0">
            <div class="row">
                <div class="col-6 x">
                    Tubaba Terkini
                </div>
                <div class="col-6 y d-flex justify-content-end align-items-end">
                    <a href="https://dapurberita.tubaba.go.id/">Lihat semua berita</a>
                </div>
            </div>
        </div>
        <div class="main p-2 p-md-3 p-lg-5 ">
            <div class="cd-slider">
                <ul>
                    <li>
                        <div class="image">
                            <img class="img-fluid" src="/assets/img/berita-pj-1.jpeg" alt="">
                        </div>
                        <div class="content">
                            <h2 class="mb-lg-5 mb-md-3">PJ Bupati Tulang Bawang Barat Menghadiri Bla Bla Bla ...</h2>
                            <a href="galeri.html">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam itaque sint
                                quisquam dicta eos explicabo quos iusto quidem error? Voluptatum reiciendis velit
                                sapiente
                                maiores atque incidunt, deleniti labore pariatur excepturi.
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="image">
                            <img class="img-fluid" src="/assets/img/berita-pj-2.jpeg" alt="">
                        </div>
                        <div class="content">
                            <h2 class="mb-lg-5 mb-md-3">BJ Bupati Tubaba Melantik Bla Bla Bla ...</h2>
                            <a href="galeri.html">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam iste praesentium
                                dignissimos nemo iure ab repudiandae nihil vitae impedit voluptatem voluptas excepturi
                                ut, accusantium ducimus reiciendis sequi dolor et sed.
                            </a>
                        </div>
                    </li>

                </ul>
            </div> <!--/.cd-slider-->
        </div>

    </section> --}}

    <!-- ====================== Pengumuman ====================== -->
    {{-- <section class="pengumuman">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8 file-peng">
                <div class="card">
                    <embed src="/assets/pengumuman/SPBE.pdf"></embed>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4 d-flex align-content-between flex-wrap">
                <div class="sub-peng">Pengumuman</div>
                <div class="txt">
                    <div class="txt-jud">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dignissimos, atque
                        vitae.</div>
                    <div class="txt-inf">
                        <ul class="fa-ul mt-2 m-0 p-0">
                            <li>
                                <i class="fa-solid fa-user"></i> <span>Admin</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-calendar-day"></i> <span>18/05/2022</span>
                            </li>
                        </ul>
                    </div>
                    <div class="link-peng">
                        <button type="button" class="btn btn-sm btn-outline-peng"><a
                                href="https://www.kejaksaan.go.id/page/link_satker">Lihat semua pengumuman</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- ================ Informasi Persyaratan ================= -->
    <section class="informasi p-4">
        <div class="text-center head p-2 mb-lg-5 mb-md-4 mb-3">Informasi Persyaratan & Panduan Penggunaan</div>
        <div id="owl-apk" class="owl-carousel owl-theme pb-lg-4 pb-mb-4 pb-2">
            <div class="item d-flex justify-content-center">
                <a href="#">
                    <div class="card">
                        <img src="/assets/img/syarat-cetak.svg" alt="">
                        <button class="btn btn-sm btn-outline-maroon mt-2">Download</button>
                    </div>
                </a>
            </div>
            <div class="item d-flex justify-content-center">
                <a href="#">
                    <div class="card">
                        <img src="/assets/img/syarat-elektronik.svg" alt="">
                        <button class="btn btn-sm btn-outline-maroon mt-2">Download</button>
                    </div>
                </a>
            </div>
            <div class="item d-flex justify-content-center">
                <a href="#">
                    <div class="card">
                        <img src="/assets/img/syarat-siber.svg" alt="">
                        <button class="btn btn-sm btn-outline-maroon mt-2">Download</button>
                    </div>
                </a>
            </div>
            <div class="item d-flex justify-content-center">
                <a href="#">
                    <div class="card">
                        <img src="/assets/img/manual-book.svg" alt="">
                        <button class="btn btn-sm btn-outline-maroon mt-2">Download</button>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection
