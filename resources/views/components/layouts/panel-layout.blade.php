<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? "SISTEM INFORMASI PLATFROM KOST" }}</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset("be-assets/images/logos/favicon.png") }}" />
        <link rel="stylesheet" href="{{ asset("be-assets/css/styles.min.css") }}" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

        @stack("styles")

        <style>
            .breadcrumb {
                border: 0;

                .breadcrumb-item>a {
                    text-decoration: none;
                    font-weight: 500;
                }
            }
        </style>

        @livewireStyles

        @vite([])
    </head>

    <body>
        <!--  Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">
            <!-- Sidebar Start -->
            <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div>
                    <div class="brand-logo d-flex align-items-center justify-content-between">
                        <a href="/" class="text-nowrap logo-img">
                            <img src="{{ asset("be-assets/images/logos/dark-logo.svg") }}" width="180"
                                alt="" />
                        </a>
                        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                            <i class="ti ti-x fs-8"></i>
                        </div>
                    </div>
                    <!-- Sidebar navigation-->
                    <x-panel-nav>

                    </x-panel-nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
            <!--  Sidebar End -->
            <!--  Main wrapper -->
            <div class="body-wrapper">
                <!--  Header Start -->

                <x-panel-header></x-panel-header>
                <!--  Header End -->
                <div class="container-fluid">
                    <nav class="mb-3"
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
            </div>
        </div>
        <script src="{{ asset("be-assets/libs/jquery/dist/jquery.min.js") }}"></script>
        <script src="{{ asset("be-assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js") }}"></script>
        <script src="{{ asset("be-assets/js/sidebarmenu.js") }}"></script>
        <script src="{{ asset("be-assets/js/app.min.js") }}"></script>
        <script src="{{ asset("be-assets/libs/simplebar/dist/simplebar.js") }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @livewireScripts

        @stack("scripts")

    </body>

</html>
