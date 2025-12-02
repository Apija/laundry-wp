<!DOCTYPE html>
<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>

    <title>Laundry</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/iconify-icons.css" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="../assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- endbuild -->

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar" onload="updateHarga()">
        <div class="layout-container">

            {{-- Sidebar --}}
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="/" class="app-brand-link">
                        <span class="app-brand-text demo menu-text fw-bold">Laundry</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="bx bx-chevron-left d-block d-xl-none"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner">
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <i class="menu-icon bx bx-home-smile"></i>
                            <div>Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('layanan') }}" class="menu-link">
                            <i class="menu-icon bx bx-basket"></i>
                            <div>Layanan</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('pelanggan') }}" class="menu-link">
                            <i class="menu-icon bx bx-user"></i>
                            <div>Member</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('laundry') }}" class="menu-link">
                            <i class="menu-icon bx bx-credit-card"></i>
                            <div>Transaksi</div>
                        </a>
                    </li>
                </ul>
            </aside>

            {{-- Page Content --}}
            <div class="layout-page">

                {{-- Navbar --}}
                <nav
                    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme">
                    <div class="layout-menu-toggle navbar-nav d-xl-none">
                        <a class="nav-item nav-link px-0" href="javascript:void(0)">
                            <i class="bx bx-menu icon-md"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center w-100">

                        {{-- Search Bar --}}
                        <div class="navbar-nav align-items-center me-auto">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search icon-md me-2"></i>
                                <input type="text" class="form-control border-0 shadow-none" placeholder="Search...">
                            </div>
                        </div>

                        {{-- Github & User Menu --}}
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="../assets/img/avatars/1.png" alt
                                                        class="w-px-40 h-auto rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">John Doe</h6>
                                                <small class="text-body-secondary">Admin</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider my-1"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider my-1"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </div>
                </nav>

                {{-- Content Wrapper --}}
                <div class="content-wrapper">
                    @yield('content')
                </div>

                {{-- Footer --}}
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex justify-content-between py-2">
                        <div>
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with ❤️ by <a href="https://themeselection.com"
                                class="footer-link">ThemeSelection</a>
                        </div>

                        <div class="d-none d-lg-inline-block">
                            <a href="#" class="footer-link me-4">Admin Templates</a>
                            <a href="#" class="footer-link me-4">Documentation</a>
                            <a href="#" class="footer-link me-4">Support</a>
                        </div>
                    </div>
                </footer>

            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- JS -->
    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/assets/vendor/js/menu.js"></script>
    <script src="/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/dashboards-analytics.js"></script>
</body>

</html>
