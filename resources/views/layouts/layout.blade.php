
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('uipack/assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link  type="image/x-icon" href="{{ asset('uipack/assets/img/support.png') }}" />
    <meta name="description" content="" />


    <!-- Favicon -->
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree&display=swap" rel="stylesheet">
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('uipack/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('uipack/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('uipack/assets/css/demo.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('uipack/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    {{--  <link rel="stylesheet" href="{{ asset('uipack/assets/vendor/libs/apex-charts/apex-charts.css') }}" /> --}}
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('uipack/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('uipack/assets/js/config.js') }}"></script>

    <style>
        .form-floating .select2-container--bootstrap-5 .select2-selection {
            height: calc(3.5rem + 2px);
            padding: 1rem 0.75rem;
        }

        .form-floating .select2-container--bootstrap-5 .select2-selection .select2-selection__rendered {
            margin-top: 0.6rem;
            margin-left: 0.25rem;
        }

        label {

            z-index: 1;
        }

        body {
            font-family: 'Bai Jamjuree', sans-serif;
        }
    </style>
    @yield('css')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route('index') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('uipack/assets/img/support.png') }}" class="w-px-50 h-auto" alt="logo">
                        </span>
                        <span class="app-brand-text fs-4 menu-text text-uppercase fw-bolder ms-2">Repair X</span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item @if (request()->routeIs('index')) active @endif"> {{-- active --}}
                        <a href="{{ route('index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>


                    <!-- Components -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Durables Goods</span>
                    </li>
                    <!-- Cards -->
                    <li class="menu-item @if (request()->routeIs('durables')) active @endif">
                        <a href="{{ route('durables') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-list-ul' ></i>
                            <div data-i18n="Basic">ทะเบียนครุภัณฑ์</div>
                        </a>
                    </li>
                    <!-- User interface -->
                    {{-- <li class="menu-item @if (request()->routeIs('durables_qrcode')) active @endif">
                        <a href="{{ route('durables_qrcode') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Basic">Qr-code ครุภัณฑ์</div>
                        </a>
                    </li> --}}
                    @php
                        $notify = DB::table('durable_fix')->where('status_id', 6)->count();
                    @endphp
                    <li class="menu-item @if (request()->routeIs('repair')) active @endif">
                        <a href="{{ route('repair') }}" class="menu-link ">
                            <i class='menu-icon tf-icons bx bx-laptop'></i>
                            <div data-i18n="Basic">แจ้งซ่อมครุภัณฑ์</div>
                            @empty($notify)
                            @else
                            <div class="badge bg-danger rounded-pill ms-auto"><i class='bx bxs-bell-ring bx-tada bx-xs'></i> {{ $notify }}</div>
                            @endempty
                            
                        </a>
                    </li>
                    <li class="menu-item @if (request()->routeIs('repair_hosxp')) active @endif">
                        <a href="{{ route('repair_hosxp') }}" class="menu-link ">
                            <i class='menu-icon tf-icons bx bx-laptop'></i>
                            <div data-i18n="Basic">แจ้งซ่อมครุภัณฑ์ (Hosxp)</div>
                        </a>
                    </li>
                    
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class='menu-icon tf-icons bx bxs-report' ></i>
                            <div data-i18n="Basic">รายงาน</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="" class="menu-link">
                                    <div data-i18n="">รายงาน 1</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="" class="menu-link">
                                    <div data-i18n="">รายงาน 2</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="" class="menu-link">
                                    <div data-i18n="">รายงาน 3</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item @if (request()->routeIs('setting_serviece') or request()->routeIs('setting_type') or request()->routeIs('setting_status')) open active @endif">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class='menu-icon tf-icons bx bx-cog'></i>
                            <div data-i18n="ตั้งค่า">ตั้งค่า</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item @if (request()->routeIs('setting_serviece')) active @endif">
                                <a href="{{ route('setting_serviece') }}" class="menu-link">
                                    <div data-i18n="ประเภทครุภัณฑ์">การบริการ</div>
                                </a>
                            </li>
                            <li class="menu-item @if (request()->routeIs('setting_type')) active @endif">
                                <a href="{{ route('setting_type') }}" class="menu-link">
                                    <div data-i18n="ปัญหา">ประเภทครุภัณฑ์</div>
                                </a>
                            </li>
                            <li class="menu-item @if (request()->routeIs('setting_status')) active @endif">
                                <a href="{{ route('setting_status') }}" class="menu-link">
                                    <div data-i18n="สถานะแจ้งซ่อม">สถานะแจ้งซ่อม</div>
                                </a>
                            </li>
                            <li class="menu-item @if (request()->routeIs('setting_engineer')) active @endif">
                                <a href="{{ route('setting_engineer') }}" class="menu-link">
                                    <div data-i18n="สถานะแจ้งซ่อม">ช่างซ่อม</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Forms & Tables -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">repair service</span>
                    </li>
                    <!-- Forms -->
                    <!-- Tables -->
                    <li class="menu-item @if (request()->routeIs('fix')) active @endif">
                        <a href="{{ route('fix') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-laptop'></i>
                            <div data-i18n="Tables">แจ้งซ่อมครุภัณฑ์</div>
                        </a>

                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                @yield('header')
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            <li class="nav-item lh-1 me-3">

                            </li>

                            <!-- User -->
                            @auth
                            
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                        data-bs-toggle="dropdown">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset('uipack/assets/img/avatars/1.png') }}" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar avatar-online">
                                                            <img src="{{ asset('uipack/assets/img/avatars/1.png') }}" alt
                                                                class="w-px-40 h-auto rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span class="fw-semibold d-block text-uppercase">{{ Auth::user()->name }}</span>
                                                        <small class="text-muted text-uppercase">{{ Auth::user()->role }}</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                        </li>
                                        {{-- <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                <span class="flex-grow-1 align-middle">Billing</span>
                                                <span
                                                    class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li> --}}
                                        <li>
                                            <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="menu-icon tf-icons bx bx-power-off me-2"></i>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                                <span class="align-middle">ออกจากระบบ</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endauth

                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->
                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        @yield('body')
                    </div>





                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by
                                <a href="https://themeselection.com" target="_blank"
                                    class="footer-link fw-bolder">Jaroenrach</a>
                            </div>
                            <div>
                                {{-- <a href="https://themeselection.com/license/" class="footer-link me-4"
                                    target="_blank">License</a>
                                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More
                                    Themes</a>

                                <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                                    target="_blank" class="footer-link me-4">Documentation</a>

                                <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                    target="_blank" class="footer-link me-4">Support</a> --}}
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                    <!-- Content wrapper -->
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('uipack/assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script src="{{ asset('uipack/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('uipack/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('uipack/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('uipack/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    {{-- <script src="{{ asset('uipack/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}
    <!-- Main JS -->
    <script src="{{ asset('uipack/assets/js/main.js') }}"></script>
    <!-- Page JS -->
    {{-- <script src="{{ asset('uipack/assets/js/dashboards-analytics.js') }}"></script> --}}
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @yield('js')
</body>

</html>
