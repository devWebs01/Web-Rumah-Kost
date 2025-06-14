<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Kos | Temukan Kos Ideal Anda</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"
            rel="stylesheet">
        <link type="text/css" rel="stylesheet" id="dark-mode-custom-link">
        <link rel="stylesheet" href="{{ asset("/fe-assets/css/style.css") }}">

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
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
                        <h5 class="footer-title">Tautan</h5>
                        <ul class="footer-links">
                            <li><a href="index.html">Beranda</a></li>
                            <li><a href="listing.html">Cari Kos</a></li>
                            <li><a href="#">Tentang Kami</a></li>
                            <li><a href="#">Kontak</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
                        <h5 class="footer-title">Layanan</h5>
                        <ul class="footer-links">
                            <li><a href="#">Pencarian Kos</a></li>
                            <li><a href="#">Booking Online</a></li>
                            <li><a href="#">Manajemen Kos</a></li>
                            <li><a href="#">Pembayaran</a></li>
                            <li><a href="#">Bantuan</a></li>
                        </ul>
                    </div>

                    <div class="copyright">
                        <p>© 2023 E-Kos. All Rights Reserved.</p>
                    </div>
                </div>
        </footer>

        <!-- Property Listing Page -->
        <div class="d-none">
            <div id="listing-page">
                <div class="container py-5 mt-5">
                    <div class="admin-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="admin-title">Cari Kos</h1>
                            </div>
                            <div class="col-md-6">
                                <nav aria-label="breadcrumb">
                                    <ol class="admin-breadcrumb breadcrumb justify-content-md-end">
                                        <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Cari Kos</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="filter-container">
                                <h5 class="filter-title">Filter Pencarian</h5>
                                <form>
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Lokasi</label>
                                        <select class="form-select" id="location">
                                            <option value="">Semua Lokasi</option>
                                            <option value="jakarta-pusat">Jakarta Pusat</option>
                                            <option value="jakarta-selatan">Jakarta Selatan</option>
                                            <option value="jakarta-barat">Jakarta Barat</option>
                                            <option value="jakarta-timur">Jakarta Timur</option>
                                            <option value="jakarta-utara">Jakarta Utara</option>
                                            <option value="depok">Depok</option>
                                            <option value="tangerang">Tangerang</option>
                                            <option value="bekasi">Bekasi</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price-range" class="form-label">Rentang Harga</label>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <input type="text" class="form-control" placeholder="Min"
                                                    id="price-min">
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" placeholder="Max"
                                                    id="price-max">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tipe Kos</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="type-putra">
                                            <label class="form-check-label" for="type-putra">
                                                Kos Putra
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="type-putri">
                                            <label class="form-check-label" for="type-putri">
                                                Kos Putri
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="type-campur">
                                            <label class="form-check-label" for="type-campur">
                                                Kos Campur
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Fasilitas</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="facility-ac">
                                            <label class="form-check-label" for="facility-ac">
                                                AC
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="facility-wifi">
                                            <label class="form-check-label" for="facility-wifi">
                                                WiFi
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="facility-kamar-mandi">
                                            <label class="form-check-label" for="facility-kamar-mandi">
                                                Kamar Mandi Dalam
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="facility-dapur">
                                            <label class="form-check-label" for="facility-dapur">
                                                Dapur
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="facility-tv">
                                            <label class="form-check-label" for="facility-tv">
                                                TV
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="facility-laundry">
                                            <label class="form-check-label" for="facility-laundry">
                                                Laundry
                                            </label>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary-custom w-100">Terapkan
                                        Filter</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari kos...">
                                        <button class="btn btn-primary-custom" type="button">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-md-end mt-3 mt-md-0">
                                    <select class="form-select" style="max-width: 200px;">
                                        <option value="newest">Terbaru</option>
                                        <option value="price-low">Harga: Rendah ke Tinggi</option>
                                        <option value="price-high">Harga: Tinggi ke Rendah</option>
                                        <option value="popular">Terpopuler</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="property-card">
                                        <div class="property-image"
                                            style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'200\' viewBox=\'0 0 400 200\'><rect width=\'400\' height=\'200\' fill=\'%234fc3f7\' opacity=\'0.3\'/><rect x=\'50\' y=\'50\' width=\'300\' height=\'100\' fill=\'%231a73e8\' opacity=\'0.5\'/><text x=\'200\' y=\'110\' font-family=\'Arial\' font-size=\'20\' text-anchor=\'middle\' fill=\'%23ffffff\'>Kos Nyaman</text></svg>');">
                                            <div class="property-badge">Populer</div>
                                        </div>
                                        <div class="property-content">
                                            <h5 class="property-title">Kos Nyaman Menteng</h5>
                                            <div class="property-location">
                                                <i class="bi bi-geo-alt"></i>
                                                <span>Menteng, Jakarta Pusat</span>
                                            </div>
                                            <div class="property-features">
                                                <div class="property-feature">
                                                    <i class="bi bi-rulers"></i>
                                                    <span>3x4 m²</span>
                                                </div>
                                                <div class="property-feature">
                                                    <i class="bi bi-lightning"></i>
                                                    <span>AC</span>
                                                </div>
                                                <div class="property-feature">
                                                    <i class="bi bi-wifi"></i>
                                                    <span>WiFi</span>
                                                </div>
                                            </div>
                                            <div class="property-price">
                                                Rp 1.500.000 <span>/ bulan</span>
                                            </div>
                                            <a href="property-detail.html" class="btn btn-primary-custom w-100">Lihat
                                                Detail</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- More property cards would be here -->
                            </div>
                            <nav aria-label="Page navigation" class="mt-5">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1"
                                            aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Property Detail Page -->
        <div class="d-none">
            <div id="property-detail-page">
                <div class="container py-5 mt-5">
                    <div class="admin-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="admin-title">Detail Kos</h1>
                            </div>
                            <div class="col-md-6">
                                <nav aria-label="breadcrumb">
                                    <ol class="admin-breadcrumb breadcrumb justify-content-md-end">
                                        <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                                        <li class="breadcrumb-item"><a href="listing.html">Cari Kos</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Detail Kos</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="property-gallery">
                                <div class="property-main-image"
                                    style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'800\' height=\'400\' viewBox=\'0 0 800 400\'><rect width=\'800\' height=\'400\' fill=\'%234fc3f7\' opacity=\'0.3\'/><rect x=\'100\' y=\'100\' width=\'600\' height=\'200\' fill=\'%231a73e8\' opacity=\'0.5\'/><text x=\'400\' y=\'210\' font-family=\'Arial\' font-size=\'30\' text-anchor=\'middle\' fill=\'%23ffffff\'>Kos Nyaman Menteng</text></svg>');">
                                </div>
                                <div class="row g-2">
                                    <div class="col-3">
                                        <div class="property-thumbnail"
                                            style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'200\' height=\'100\' viewBox=\'0 0 200 100\'><rect width=\'200\' height=\'100\' fill=\'%234fc3f7\' opacity=\'0.3\'/><rect x=\'25\' y=\'25\' width=\'150\' height=\'50\' fill=\'%231a73e8\' opacity=\'0.5\'/><text x=\'100\' y=\'55\' font-family=\'Arial\' font-size=\'12\' text-anchor=\'middle\' fill=\'%23ffffff\'>Kamar</text></svg>');">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="property-thumbnail"
                                            style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'200\' height=\'100\' viewBox=\'0 0 200 100\'><rect width=\'200\' height=\'100\' fill=\'%234fc3f7\' opacity=\'0.4\'/><rect x=\'25\' y=\'25\' width=\'150\' height=\'50\' fill=\'%231a73e8\' opacity=\'0.6\'/><text x=\'100\' y=\'55\' font-family=\'Arial\' font-size=\'12\' text-anchor=\'middle\' fill=\'%23ffffff\'>Kamar Mandi</text></svg>');">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="property-thumbnail"
                                            style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'200\' height=\'100\' viewBox=\'0 0 200 100\'><rect width=\'200\' height=\'100\' fill=\'%234fc3f7\' opacity=\'0.5\'/><rect x=\'25\' y=\'25\' width=\'150\' height=\'50\' fill=\'%231a73e8\' opacity=\'0.7\'/><text x=\'100\' y=\'55\' font-family=\'Arial\' font-size=\'12\' text-anchor=\'middle\' fill=\'%23ffffff\'>Dapur</text></svg>');">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="property-thumbnail"
                                            style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'200\' height=\'100\' viewBox=\'0 0 200 100\'><rect width=\'200\' height=\'100\' fill=\'%234fc3f7\' opacity=\'0.6\'/><rect x=\'25\' y=\'25\' width=\'150\' height=\'50\' fill=\'%231a73e8\' opacity=\'0.8\'/><text x=\'100\' y=\'55\' font-family=\'Arial\' font-size=\'12\' text-anchor=\'middle\' fill=\'%23ffffff\'>Ruang Tamu</text></svg>');">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="admin-card">
                                <h2 class="property-detail-title">Kos Nyaman Menteng</h2>
                                <div class="property-detail-location">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>Jl. Menteng Raya No. 45, Menteng, Jakarta Pusat</span>
                                </div>
                                <div class="property-detail-price">
                                    Rp 1.500.000 <span>/ bulan</span>
                                </div>
                                <div class="property-detail-features">
                                    <div class="property-detail-feature">
                                        <i class="bi bi-rulers"></i>
                                        <span>Ukuran: 3x4 m²</span>
                                    </div>
                                    <div class="property-detail-feature">
                                        <i class="bi bi-gender-ambiguous"></i>
                                        <span>Tipe: Kos Putri</span>
                                    </div>
                                    <div class="property-detail-feature">
                                        <i class="bi bi-lightning"></i>
                                        <span>AC</span>
                                    </div>
                                    <div class="property-detail-feature">
                                        <i class="bi bi-wifi"></i>
                                        <span>WiFi</span>
                                    </div>
                                    <div class="property-detail-feature">
                                        <i class="bi bi-droplet"></i>
                                        <span>Kamar Mandi Dalam</span>
                                    </div>
                                </div>
                                <div class="property-detail-description">
                                    <h5>Deskripsi</h5>
                                    <p>Kos Nyaman Menteng menawarkan hunian yang strategis di pusat kota Jakarta.
                                        Dengan
                                        akses mudah ke berbagai fasilitas umum seperti pusat perbelanjaan, rumah sakit,
                                        dan
                                        transportasi umum, kos ini sangat ideal untuk mahasiswa dan profesional muda.
                                    </p>
                                    <script>
                                        (function() {
                                            function c() {
                                                var b = a.contentDocument || a.contentWindow.document;
                                                if (b) {
                                                    var d = b.createElement('script');
                                                    d.innerHTML =
                                                        "window.__CF$cv$params={r:'9474fdc0e537ce66',t:'MTc0ODUxMTIxNy4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                                                    b.getElementsByTagName('head')[0].appendChild(d)
                                                }
                                            }
                                            if (document.body) {
                                                var a = document.createElement('iframe');
                                                a.height = 1;
                                                a.width = 1;
                                                a.style.position = 'absolute';
                                                a.style.top = 0;
                                                a.style.left = 0;
                                                a.style.border = 'none';
                                                a.style.visibility = 'hidden';
                                                document.body.appendChild(a);
                                                if ('loading' !== document.readyState) c();
                                                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                                                else {
                                                    var e = document.onreadystatechange || function() {};
                                                    document.onreadystatechange = function(b) {
                                                        e(b);
                                                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                                                    }
                                                }
                                            }
                                        })();
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

        @livewireScripts

        @stack("scripts")
    </body>

</html>
