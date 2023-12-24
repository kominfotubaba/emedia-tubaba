<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Media Tubaba</title>

    <meta property="og:description" content='' />
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="/assets/img/kominfo-putih.svg">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="author" content="Kejari Tubaba">
    <meta name="robots" content="all,index,follow">
    <meta http-equiv="Content-Language" content="id-ID">
    <meta NAME="Distribution" CONTENT="Global">
    <meta NAME="Rating" CONTENT="General">
    <link rel="canonical" href="#" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="#" />
    <meta property="og:site_name" content="emedia.tubaba.go.id" />
    <meta property="og:title" content="emedia.tubaba.go.id" />
    <meta name="description" content="">

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" /> --}}

    <link rel="stylesheet" href="/assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
        integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"
        integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href=" https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" />

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" /> --}}

    <link rel="stylesheet" href="/assets/css/vendor/datatables.min.css" />

    {{-- <link rel="stylesheet" href="/assets/css/styles.css" /> --}}
    <link rel="stylesheet" href="/assets/css/style.css">

</head>

<body>
    <!-- ======================== navbar ========================= -->
    <section>
        <nav id="navbar" class="fixed-top">
            <div class="navbar nav-color">
                <div class="container-fluid">
                    <a class="navbar-brand m-0 ps-1 ps-md-3 ps-lg-3" href="/">
                        <img src="/assets/logo/guwai.png" alt="">
                    </a>
                    <ul class="nav justify-content-end mt-0 mb-0 p-0">
                        <li class="nav-link m-0 p-1 p-md-2 p-lg-3">
                            <a href="/">Beranda</a>
                        </li>
                        {{-- <li class="nav-item dropdown m-0 p-2 p-md-2 p-lg-3">
                            <a class="nav-link dropdown-toggle p-0 m-0" data-bs-toggle="dropdown" href="#"
                                role="button" aria-expanded="false">Data</a>
                            <ul class="dropdown-menu modif-drop mt-3">
                                <li><a class="dropdown-item m-0" href="/data-perusahaan">Data Perusahaan</a></li>
                                <li><a class="dropdown-item m-0" href="/data-media">Data Media</a></li>
                                <li><a class="dropdown-item m-0" href="/data-perwakilan-media">Data Perwakilan</a>
                                </li>
                            </ul>
                        </li> --}}
                        @if (Auth::user() == null)
                            <li class="nav-link m-0 p-1 p-md-2 p-lg-3">
                                <a href="/login">Login</a>
                            </li>
                        @else
                            <li class="nav-link m-0 p-1 p-md-2 p-lg-3">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    @yield('content')

    <!-- ======================= Footer ========================= -->
    <footer class="mt-5 m-0 p-0">
        <div class="content">
            <div>
                <div class="d-flex justify-content-center">
                    <div class="name-app text-center mt-3">
                        EMEDIA TUBABA
                    </div>
                </div>
                <div class="ttg">
                    <div class="row">
                        <div class="col-12">
                            <div class="line mb-3 mt-3"></div>

                            <div class="d-lg-flex d-md-flex d-grid">
                                <div>
                                    <div
                                        class="logo mt-1 d-flex justify-content-lg-start justify-content-md-start justify-content-center">
                                        <img class="img-fluid m-0 p-0" src="/assets/img/kominfo-putih.svg"
                                            alt="">
                                    </div>
                                </div>
                                <div class="text-lg text-md text-center mt-lg-0 mt-md-0 mt-2 ms-lg-4 ms-md-4 ms-0">
                                    <div class="text-lg-start text-md-start fw-light fst-italic">Aplikasi ini
                                        dikelola
                                        Oleh:
                                    </div>
                                    <div class="mt-lg-1 mt-md-1 mt-0">
                                        <span class="bold">Diskominfo Tubaba</span> <span class="cc">| Versi
                                            3.2</span>
                                    </div>
                                </div>
                                <div class="ms-lg-auto ms-md-auto ms-0">
                                    <div class="d-grid icon">
                                        <div class="fw-light fst-italic mb-1 mb-md-2 mb-lg-2">Contact:</div>
                                        <div class="row">
                                            <div class="col-lg-auto col-md-auto col-6">
                                                <div class="m-0 p-0">
                                                    <a href="#">
                                                        <i class="fa-solid fa-square-envelope"></i>
                                                        kominfo@tubaba.go.id
                                                    </a>
                                                </div>
                                                <div class="m-0 p-0">
                                                    <a href="https://www.instagram.com/kominfo.tubaba/">
                                                        <i class="fa-brands fa-square-instagram"></i>
                                                        kominfo.tubaba
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-auto col-md-auto col-6">
                                                <div class="m-0 p-0">
                                                    <a href="https://web.facebook.com/kominfotubaba">
                                                        <i class="fa-brands fa-square-facebook"></i>
                                                        kominfotubaba
                                                    </a>
                                                </div>
                                                <div class="m-0 p-0">
                                                    <a href="https://www.tiktok.com/@kominfotubaba">
                                                        <i class="fa-brands fa-tiktok"></i>kominfotubaba
                                                        {{-- <i class="fa-brands fa-square-tiktok"></i> kominfotubaba --}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
        integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> --}}
    <script src="/assets/js/vendor/datatables.min.js"></script>
    <script src="/assets/js/cs/datatable.extend.js"></script>
    <script src="/assets/js/plugins/datatable.boxedvariations.js"></script>

    <script src="/assets/icon/acorn-icons.js"></script>
    <script src="/assets/icon/acorn-icons-interface.js"></script>
    <script src="/assets/icon/acorn-icons-commerce.js"></script>
    <script src="/assets/icon/acorn-icons-learning.js"></script>
    <script src="/assets/icon/acorn-icons-medical.js"></script>

    <script src="/assets/js/script.js"></script>
    @stack('script')
</body>



</html>
