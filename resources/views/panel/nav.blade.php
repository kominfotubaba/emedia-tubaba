<div id="nav" class="nav-container d-flex">
    <div class="nav-content d-flex">

        <!-- Logo Start -->
        <div class="logo position-relative">
            <a href="#">
                <!-- Logo can be added directly -->
                <!-- Or added via css to provide different ones for different color themes -->
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <img src="/assets/img/logo/kombinasi.png" class="img-fluid" alt="" />
                    </div>
                </div>
            </a>
        </div>
        <!-- Logo End -->

        <!-- User Menu Start -->
        <div class="user-container d-flex">
            <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <img class="profile" alt="profile"
                    src="
                @if (Auth::user()->foto == null) /assets/img/logo/user_logo.png @else
                /tmp/img/user/{{ Auth::user()->foto }} @endif
                " />
                <div class="name">{{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-end user-menu wide">
                <div class="row mb-0 ms-0 me-0">
                    <div class="col-12 ps-1 mb-2">
                        <div class="text-extra-small text-primary">ACCOUNT</div>
                    </div>
                    <div class="col-6 ps-1 pe-1">
                        <ul class="list-unstyled">
                            <li>
                                <a href="#">User Info</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row mb-1 ms-0 me-0">
                    <div class="col-12 p-1 mb-3 pt-3">
                        <div class="separator-light"></div>
                    </div>
                    <div class="col-12 pe-1 ps-1">
                        <ul class="list-unstyled">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-background-alternate p-0 m-0"> <i
                                            data-acorn-icon="logout" class="me-2" data-acorn-size="17"></i>
                                        <span class="align-middle">Logout </span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Menu End -->

        <!-- Icons Menu Start -->
        <ul class="list-unstyled list-inline text-center menu-icons">
            <li class="list-inline-item">
                <a href="#" data-bs-toggle="modal" data-bs-target="#searchPagesModal">
                    <i data-acorn-icon="search" data-acorn-size="18"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#" id="pinButton" class="pin-button">
                    <i data-acorn-icon="lock-on" class="unpin" data-acorn-size="18"></i>
                    <i data-acorn-icon="lock-off" class="pin" data-acorn-size="18"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#" id="colorButton">
                    <i data-acorn-icon="light-on" class="light" data-acorn-size="18"></i>
                    <i data-acorn-icon="light-off" class="dark" data-acorn-size="18"></i>
                </a>
            </li>
        </ul>
        <!-- Icons Menu End -->

        @php
            $pengajuan = App\Models\tahun::select('tahun')
                ->where('pengajuan', 1)
                ->count();
        @endphp

        <!-- Menu Start -->
        <div class="menu-container flex-grow-1">
            <ul id="menu" class="menu">
                <li>
                    <a href="/dashboard">
                        <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                        <span class="label">Dashboards</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'user')
                    <li>
                        <a href="#pengajuan">
                            <i data-acorn-icon="quiz" class="icon" data-acorn-size="18"></i>
                            <span class="label">Pengajuan</span>
                        </a>
                        <ul id="pengajuan">
                            <li>
                                <a href="/daftar">
                                    <span class="label">Daftar Pengajuan</span>
                                </a>
                            </li>
                            @if (Auth::user()->role == 'user')
                                @if ($pengajuan == 1)
                                    <li>
                                        <a href="/pengajuan/index">
                                            <span class="label">Pengajuan</span>
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'operator')
                    <li>
                        <a href="#order">
                            <i data-acorn-icon="invoice" class="icon" data-acorn-size="18"></i>
                            <span class="label">Order</span>
                        </a>
                        <ul id="order">
                            <li>
                                <a href="/order/create">
                                    <i data-acorn-icon="shipping" class="icon" data-acorn-size="18"></i>
                                    <span class="label">Buat Pesanan</span>
                                </a>
                            </li>
                            <li>
                                <a href="/order/daftar">
                                    <i data-acorn-icon="exchange" class="icon" data-acorn-size="18"></i>
                                    <span class="label">Daftar Pesanan</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'user')
                    <li>
                        <a href="/bukti_tayang">
                            <i data-acorn-icon="online-class" class="icon" data-acorn-size="18"></i>
                            <span class="label">bukti</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 'admin')
                    <li>
                        <a href="#tools">
                            <i data-acorn-icon="tool" class="icon" data-acorn-size="18"></i>
                            <span class="label">tools</span>
                        </a>
                        <ul id="tools">
                            <li>
                                <a href="/paket">
                                    <i data-acorn-icon="boxes" class="icon" data-acorn-size="18"></i>
                                    <span class="label">Paket</span>
                                </a>
                            </li>
                            <li>
                                <a href="/budget">
                                    <i data-acorn-icon="balance" class="icon" data-acorn-size="18"></i>
                                    <span class="label">Budget Tahunan</span>
                                </a>
                            </li>
                            <li>
                                <a href="/setting">
                                    <i data-acorn-icon="gear" class="icon" data-acorn-size="18"></i>
                                    <span class="label">setting</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- Menu End -->

        <!-- Mobile Buttons Start -->
        <div class="mobile-buttons-container">
            <!-- Scrollspy Mobile Button Start -->
            <a href="#" id="scrollSpyButton" class="spy-button" data-bs-toggle="dropdown">
                <i data-acorn-icon="menu-dropdown"></i>
            </a>
            <!-- Scrollspy Mobile Button End -->

            <!-- Scrollspy Mobile Dropdown Start -->
            <div class="dropdown-menu dropdown-menu-end" id="scrollSpyDropdown"></div>
            <!-- Scrollspy Mobile Dropdown End -->

            <!-- Menu Button Start -->
            <a href="#" id="mobileMenuButton" class="menu-button">
                <i data-acorn-icon="menu"></i>
            </a>
            <!-- Menu Button End -->
        </div>
        <!-- Mobile Buttons End -->
    </div>
    <div class="nav-shadow"></div>
</div>
