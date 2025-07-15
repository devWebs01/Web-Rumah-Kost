<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $website->name ?? "" }} | Temukan Kos Ideal Anda</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"
            rel="stylesheet">
        <link type="text/css" rel="stylesheet" id="dark-mode-custom-link">
        <link rel="stylesheet" href="{{ asset("/fe-assets/css/style.css") }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

        @livewireStyles

        @stack("styles")

        @vite([])
    </head>

    <body>
        <!-- Navigation -->
        <x-guest-nav></x-guest-nav>

        <main class="py-5">
            {{ $slot }}
        </main>

        <div class="d-none position-fixed bottom-0 end-0 m-4" wire:loading.class.remove="d-none" style="z-index: 9999;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg mb-5 mb-lg-0">
                        <h3 class="footer-title">E-Kos</h3>
                        <p class="text-white-50 mb-4">Platform terintegrasi untuk pencarian, booking, dan manajemen
                            kos
                            secara online. Temukan hunian nyaman sesuai kebutuhan Anda.</p>
                        <div class="footer-social">
                            <a href="{{ $website->facebook ?? "" }}"><i class="bi bi-facebook"></i></a>
                            <a href="{{ $website->twitter ?? "" }}"><i class="bi bi-twitter"></i></a>
                            <a href="{{ $website->instagram ?? "" }}"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
                        <h5 class="footer-title">Tautan</h5>
                        <ul class="footer-links">
                            <li><a href="/">Beranda</a></li>
                            <li><a href="{{ route("catalog.listing") }}">Cari Kos</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
                        <h5 class="footer-title">Layanan</h5>
                        <ul class="footer-links">
                            <li><a href="#">Pencarian Kos</a></li>
                            <li><a href="#">Booking Online</a></li>
                            <li><a href="#">Manajemen Kos</a></li>
                        </ul>
                    </div>

                    <div class="copyright">
                        <p>© 2023 E-Kos. All Rights Reserved.</p>
                    </div>
                </div>
        </footer>

        @include("components.partials.config")

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <iframe height="1" width="1"
            style="position: absolute; top: 0px; left: 0px; border: none; visibility: hidden;"></iframe>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://kit.fontawesome.com/49d7584956.js" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
        <script>
            Fancybox.bind("[data-fancybox]", {
                // Your custom options
            });
        </script>

        @stack("scripts")

        @livewireScripts
    </body>

</html>
