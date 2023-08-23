<!DOCTYPE html>
<html lang="en">

@include('panel.head')

<body>
    <div id="root" class="bg-dark text-black">
        <!-- Background Start -->
        <!-- <div class="fixed-background bg-dark"></div> -->
        <!-- Background End -->

        <div id="nav" class="nav-container d-flex">
            <div class="nav-content d-flex justify-content-between">
                <!-- Logo Start -->
                <div class="logo position-relative">
                    <a href="Dashboards.Default.html">
                        <!-- Logo can be added directly -->
                        <img src="assets/img/logo/kombinasi.png" alt="logo" />
                    </a>
                </div>
                <!-- Logo End -->

                <!-- Menu Start -->
                <div class="menu-container flex-grow-1">
                    <ul id="menu" class="menu">
                    </ul>
                </div>
                <!-- Menu End -->

                <!-- User Menu Start -->
                <div class="logo d-flex justify-content-end">
                    <a class="text-white p-1" href="{{ route('login') }}">Login</a>
                </div>
                <!-- User Menu End -->
            </div>
            <div class="nav-shadow"></div>
        </div>

        <main>
            <div class="container mt-4">
                <!-- PopUp -->

                <div class="p-0 m-0 modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-body">
                            {{-- <img src="/tmp/banner/perubahan.jpg" class="img-fluid" alt="..."> --}}
                            <img src="assets/img/banner/perpanjangan.jpg" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>

                <!-- Content Start -->
                <div class="card bg-primary shadow p-2">
                    <div class="card p-2 d-flex">
                        <div class="card border-1 p-2">
                            <div class="row d-flex align-items-center">
                                <div class="col-lg-4 col-md-6 col-12 d-flex text-center justify-content-center">
                                    <div>
                                        <img class="img-fluid w-25 mb-2 p-2" src="/assets/logo/emedia.png"
                                            alt="">
                                        <h4>Registrasi/pendaftaran media secara online bagi Media Cetak, Online dan
                                            Elektronik</h4>

                                        <a class="btn btn-primary mb-1 mt-2"
                                            href="assets/contoh/Manual Book Pendaftaran E Media-NG.pdf"
                                            role="button">Download
                                            Manual
                                            Book</a>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6 col-12">
                                    <img class="img-fluid p-2" src="/assets/logo/imgmedia.jpg" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="card border-1 mt-4 p-2">
                            <div class="row p-2">
                                <h1>Informasi</h1>
                                <div class="col-lg-5 col-md-5 col-12 p-2">
                                    <p class="p-2">Pendaftaran Dibuka!</p>
                                </div>
                                <!-- Polar Chart Start -->
                                {{-- <div class="col-lg-7 col-md-7 col-12 p-2 d-flex justify-content-lg-center">
                                    <div class="p-2">
                                        <h6 class="text-center mb-2">Data Dalam Persentase</h6>
                                        <section class="scroll-section" id="polarChartTitle">
                                            <div class="sh-35">
                                                <canvas id="polarChart"></canvas>
                                            </div>
                                        </section>
                                    </div>
                                </div> --}}
                                <!-- Polar Chart End -->
                            </div>
                        </div>

                        <div class="card p-2 mt-4">
                            <div class="row d-flex">
                                <div class="col-lg-6 col-md-6 col-12 p-2">
                                    <div class="card border-1 p-2">
                                        <h1>Persyaratan</h1>

                                        <div class="p-2 d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="cs-icon cs-icon-navigate-right">
                                                <path
                                                    d="M3.98595 3.32709L16.9439 9.08619C17.7357 9.43811 17.7357 10.5619 16.9439 10.9138L3.98595 16.6729C3.08463 17.0735 2.20906 16.0655 2.73181 15.2291L4.34375 12.65C5.3571 11.0286 5.3571 8.97136 4.34375 7.35L2.73181 4.7709C2.20906 3.9345 3.08464 2.9265 3.98595 3.32709Z">
                                                </path>
                                            </svg>
                                            <h6 class="ps-2">Unduh persyaratan <a
                                                    href="assets/contoh/PERSYARATAN MEDIA SIBER.pdf">Media
                                                    Siber</a> </h6>
                                        </div>

                                        <div class="p-2 d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="cs-icon cs-icon-navigate-right">
                                                <path
                                                    d="M3.98595 3.32709L16.9439 9.08619C17.7357 9.43811 17.7357 10.5619 16.9439 10.9138L3.98595 16.6729C3.08463 17.0735 2.20906 16.0655 2.73181 15.2291L4.34375 12.65C5.3571 11.0286 5.3571 8.97136 4.34375 7.35L2.73181 4.7709C2.20906 3.9345 3.08464 2.9265 3.98595 3.32709Z">
                                                </path>
                                            </svg>
                                            <h6 class="ps-2">Unduh persyaratan <a
                                                    href="assets/contoh/PERSYARATAN MEDIA ELEKTRONIK.pdf">
                                                    Media Elektronik</a></h6>
                                        </div>

                                        <div class="p-2 d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="cs-icon cs-icon-navigate-right">
                                                <path
                                                    d="M3.98595 3.32709L16.9439 9.08619C17.7357 9.43811 17.7357 10.5619 16.9439 10.9138L3.98595 16.6729C3.08463 17.0735 2.20906 16.0655 2.73181 15.2291L4.34375 12.65C5.3571 11.0286 5.3571 8.97136 4.34375 7.35L2.73181 4.7709C2.20906 3.9345 3.08464 2.9265 3.98595 3.32709Z">
                                                </path>
                                            </svg>
                                            <h6 class="ps-2">Unduh persyaratan <a
                                                    href="assets/contoh/PERSYARATAN MEDIA CETAK.pdf">Media
                                                    Cetak/Harian</a></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 p-2">
                                    <div class="card border-1">
                                        <h1 class="p-2">Bantuan</h1>
                                        <div class="p-2 d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="cs-icon cs-icon-navigate-right">
                                                <path
                                                    d="M3.98595 3.32709L16.9439 9.08619C17.7357 9.43811 17.7357 10.5619 16.9439 10.9138L3.98595 16.6729C3.08463 17.0735 2.20906 16.0655 2.73181 15.2291L4.34375 12.65C5.3571 11.0286 5.3571 8.97136 4.34375 7.35L2.73181 4.7709C2.20906 3.9345 3.08464 2.9265 3.98595 3.32709Z">
                                                </path>
                                            </svg>
                                            <h6 class="ps-2">Unduh<a
                                                    href="assets/contoh/Manual Book Pendaftaran E Media-NG.pdf">
                                                    Manual Book</a></h6>
                                        </div>

                                        <div class="p-2 d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="cs-icon cs-icon-navigate-right">
                                                <path
                                                    d="M3.98595 3.32709L16.9439 9.08619C17.7357 9.43811 17.7357 10.5619 16.9439 10.9138L3.98595 16.6729C3.08463 17.0735 2.20906 16.0655 2.73181 15.2291L4.34375 12.65C5.3571 11.0286 5.3571 8.97136 4.34375 7.35L2.73181 4.7709C2.20906 3.9345 3.08464 2.9265 3.98595 3.32709Z">
                                                </path>
                                            </svg>
                                            <h6 class="ps-2">
                                                Hubungi <a href="">kominfo@tubaba.go.id</a> jika terdapat
                                                pertanyaan ataupun kendala dalam
                                                penggunaan
                                                E-Media</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content End -->
        </main>
        <!-- Layout Footer Start -->
        {{-- <footer>
            <div class="footer-content d-flex justify-content-center">
                <div class="row d-flex justify-content-center align-content-center">
                    <div class="col-2 pt-2 pb-1">
                        <img class="img-fluid w-40" src="assets/img/logo/Lambang Tubaba.png" alt="">
                    </div>
                </div>
            </div>
        </footer> --}}
        <!-- Layout Footer End -->
    </div>
    @include('panel.script')
</body>

</html>
