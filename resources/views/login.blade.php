<!DOCTYPE html>
<html lang="en">

@include('panel.head')

<body class="h-100">
    <div id="root" class="h-100 bg-dark">
        <!-- Background Start -->
        {{-- <div class="fixed-background">
            <img src="/assets/img/background/wp7137882-lenovo-yoga-wallpapers.jpg" alt="">
        </div> --}}
        <!-- Background End -->

        <div class="container-fluid p-0 h-100 position-relative">
            <div class="row g-0 h-100">
                <!-- Left Side Start -->
                <div class="offset-0 col-12 d-none d-lg-flex offset-md-1 col-lg h-lg-100">
                    <div class="min-h-100 d-flex align-items-center">
                        <div class="w-100 w-lg-75 w-xxl-50">
                            <div>
                                <div class="mb-5">
                                    <h1 class="display-3 text-white">Pilihan Terbaik</h1>
                                    <h1 class="display-3 text-white">Memberikan Layanan Yang Prima</h1>
                                </div>
                                <p class="h6 text-white lh-1-5 mb-5">
                                    Mari manfaatkan fungsi integrasi data melalui aplikasi ini dengan rasa tanggung
                                    jawab.
                                    Apabila Terjadi Kendala Silahkan Menghubungi Kominfo@tubaba.go.id
                                </p>
                                <div class="mb-5">
                                    {{-- <a class="btn btn-lg btn-outline-white" href="index.html">Learn More</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Left Side End -->

                <!-- Right Side Start -->
                <div class="col-12 col-lg-auto h-100 pb-4 px-4 pt-0 p-lg-0">
                    <div
                        class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
                        <div class="sw-lg-50 px-5">
                            <div class="sh-11">
                                <a href="#">
                                    <img src="/assets/img/logo/logo_kominfo_blue.png" alt="" width="50">
                                </a>
                            </div>
                            <div class="mb-5">
                                <h2 class="cta-1 mb-0 text-primary">Tabikpun</h2>
                            </div>
                            <div class="mb-5">
                                <p class="h6">Gunakan Form Login Untuk Masuk.</p>
                                <p class="h6">
                                    Apabila Belum Memiliki Akun Silahkan
                                    <a href="{{ route('register') }}">Register.</a>
                                </p>
                            </div>
                            @if (session()->has('register'))
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    {!! session('register') !!}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {!! session('loginError') !!}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div>
                                <form id="loginForm" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="user"></i>
                                        <input id="email" type="text" placeholder="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="switch-off"></i>
                                        <input id="password" type="password" placeholder="Passsword"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Side End -->
            </div>
        </div>
    </div>
    <!-- Theme Settings & Niches Buttons End -->
    @include('panel.script')
    <script>
        $(document).ready(function() {
            // jQuery.validator.setDefaults({
            //     debug: false,
            //     success: "valid"
            // });
            jQuery.validator.addMethod("noSpace", function(value, element) {
                return value.indexOf(" ") < 0 && value != "";
            }, "No space please and don't leave it empty");

            $("#loginForm").validate({
                rules: {
                    password: {
                        required: true,
                    },

                    username: {
                        required: true,
                        noSpace: true
                    },
                },
            });

            $(".show-hide").on('click', function(event) {
                console.log('okkk');
                event.preventDefault();
                if ($('#password').attr("type") == "text") {
                    $('#password').attr('type', 'password');
                    $('.show-hide').addClass("fa fa-eye-slash");
                    $('.show-hide').removeClass("fa-regular fa-eye");
                } else if ($('#password').attr("type") == "password") {
                    $('#password').attr('type', 'text');
                    $('.show-hide ').removeClass("fa fa-eye-slash");
                    $('.show-hide ').addClass("fa-regular fa-eye");
                }
            });
        });
    </script>
</body>

</html>
