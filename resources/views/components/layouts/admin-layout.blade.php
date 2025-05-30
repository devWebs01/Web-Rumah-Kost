<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ $title ?? "" }}</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="/be-assets/vendors/feather/feather.css">
        <link rel="stylesheet" href="/be-assets/vendors/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="/be-assets/vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="/be-assets/vendors/typicons/typicons.css">
        <link rel="stylesheet" href="/be-assets/vendors/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="/be-assets/vendors/css/vendor.bundle.base.css">
        <!-- endinject -->

        @livewireStyles

        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="/be-assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="/be-assets/js/select.dataTables.min.css">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="/be-assets/css/vertical-layout-light/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="/be-assets/images/favicon.png" />

        <style>
            .breadcrumb {
                border: 0;

                .breadcrumb-item>a {
                    color: black;
                    text-decoration: none;
                    font-weight: bolder;
                }
            }
        </style>

        @stack("styles")

        @vite([])
    </head>

    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                    <div class="me-3">
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                            data-bs-toggle="minimize">
                            <span class="icon-menu"></span>
                        </button>
                    </div>
                    <div>
                        <a class="navbar-brand brand-logo" href="{{ route("home") }}">
                            <img src="/be-assets/images/logo.svg" alt="logo" />
                        </a>
                        <a class="navbar-brand brand-logo-mini" href="{{ route("home") }}">
                            <img src="https://api.dicebear.com/9.x/adventurer/svg?seed={{ Auth::user()->name ?? "udin" }}"
                                alt="logo" />
                        </a>
                    </div>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-top">
                    <ul class="navbar-nav">
                        <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                            <h3 class="-text">Hello, <span
                                    class="text-black fw-bold">{{ Auth::user()->name ?? "udin" }}</span></h3>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link count-indicator" id="countDropdown" href="#"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="icon-bell"></i>
                                <span class="count"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                                aria-labelledby="countDropdown">
                                <a class="dropdown-item py-3">
                                    <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                                    <span class="badge badge-pill badge-primary float-right">View all</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="/be-assets/images/faces/face10.jpg" alt="image"
                                            class="img-sm profile-pic">
                                    </div>
                                    <div class="preview-item-content flex-grow py-2">
                                        <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner
                                        </p>
                                        <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="/be-assets/images/faces/face12.jpg" alt="image"
                                            class="img-sm profile-pic">
                                    </div>
                                    <div class="preview-item-content flex-grow py-2">
                                        <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey
                                        </p>
                                        <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="/be-assets/images/faces/face1.jpg" alt="image"
                                            class="img-sm profile-pic">
                                    </div>
                                    <div class="preview-item-content flex-grow py-2">
                                        <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins
                                        </p>
                                        <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img class="img-xs rounded-circle"
                                    src="https://api.dicebear.com/9.x/adventurer/svg?seed={{ Auth::user()->name ?? "luis" }}"
                                    alt="Profile image">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="UserDropdown">
                                <div class="dropdown-header text-center">
                                    <img class="img-md rounded-circle w-25"
                                        src="https://api.dicebear.com/9.x/adventurer/svg?seed={{ Auth::user()->name ?? "luis" }}"
                                        alt="Profile image">
                                    <p class="mb-1 mt-3 font-weight-semibold">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p class="fw-light text-muted mb-0">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>
                                <a class="dropdown-item"><i
                                        class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
                                    Profile <span class="badge badge-pill badge-danger">1</span></a>
                                <a class="dropdown-item"><i
                                        class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i>
                                    Messages</a>
                                <a class="dropdown-item"><i
                                        class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i>
                                    Activity</a>
                                <a class="dropdown-item"><i
                                        class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i>
                                    FAQ</a>
                                <a class="dropdown-item"><i
                                        class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-bs-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <div class="theme-setting-wrapper d-none">
                    <div id="settings-trigger"><i class="ti-settings"></i></div>
                    <div id="theme-settings" class="settings-panel">
                        <i class="settings-close ti-close"></i>
                        <p class="settings-heading">SIDEBAR SKINS</p>
                        <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                            <div class="img-ss rounded-circle bg-light border me-3"></div>Light
                        </div>
                        <div class="sidebar-bg-options" id="sidebar-dark-theme">
                            <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
                        </div>
                        <p class="settings-heading mt-2">HEADER SKINS</p>
                        <div class="color-tiles mx-0 px-4">
                            <div class="tiles success"></div>
                            <div class="tiles warning"></div>
                            <div class="tiles danger"></div>
                            <div class="tiles info"></div>
                            <div class="tiles dark"></div>
                            <div class="tiles default"></div>
                        </div>
                    </div>
                </div>

                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <x-admin-nav></x-admin-nav>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">

                        <nav class="d-print-none bg-white rounded-4"
                            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);     border-radius: 20px;"
                            aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route("home") }}">Dashboard</a>
                                </li>

                                @if (isset($header))
                                    {{ $header }}
                                @endif
                            </ol>
                        </nav>

                        {{ $slot }}

                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                                    href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a>
                                from BootstrapDash.</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021.
                                All rights reserved.</span>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        <!-- plugins:js -->
        <script src="/be-assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->

        <!-- Plugin js for this page -->
        {{-- <script src="/be-assets/vendors/chart.js/Chart.min.js"></script> --}}
        {{-- <script src="/be-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script> --}}
        {{-- <script src="/be-assets/vendors/progressbar.js/progressbar.min.js"></script> --}}
        <!-- End plugin js for this page -->
        <!-- Custom js for this page-->
        {{-- <script src="/be-assets/js/dashboard.js"></script>
        <script src="/be-assets/js/Chart.roundedBarCharts.js"></script> --}}
        <!-- End custom js for this page-->

        <!-- inject:js -->
        <script src="/be-assets/js/off-canvas.js"></script>
        <script src="/be-assets/js/hoverable-collapse.js"></script>
        <script src="/be-assets/js/template.js"></script>
        <script src="/be-assets/js/settings.js"></script>
        {{-- <script src="/be-assets/js/todolist.js"></script> --}}
        <!-- endinject -->

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @stack("scripts")

        @livewireScripts
    </body>

</html>
