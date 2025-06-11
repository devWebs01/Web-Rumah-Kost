<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Kost | Temukan Kost Ideal Anda</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
        <style>
            :root {
                --primary: #1a73e8;
                --primary-dark: #0d47a1;
                --secondary: #4fc3f7;
                --light: #f5f9ff;
                --dark: #333333;
                --gray: #f8f9fa;
            }

            body {
                font-family: 'Poppins', sans-serif;
                color: var(--dark);
                overflow-x: hidden;
            }

            .bg-primary-custom {
                background-color: var(--primary);
            }

            .bg-light-custom {
                background-color: var(--light);
            }

            .btn-primary-custom {
                background-color: var(--primary);
                border-color: var(--primary);
                color: white;
                padding: 10px 24px;
                border-radius: 6px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-primary-custom:hover {
                background-color: var(--primary-dark);
                border-color: var(--primary-dark);
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(26, 115, 232, 0.2);
            }

            .btn-outline-primary-custom {
                background-color: transparent;
                border: 2px solid var(--primary);
                color: var(--primary);
                padding: 10px 24px;
                border-radius: 6px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-outline-primary-custom:hover {
                background-color: var(--primary);
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(26, 115, 232, 0.2);
            }

            .navbar {
                padding: 15px 0;
                transition: all 0.3s ease;
            }

            .navbar-scrolled {
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                background-color: white !important;
            }

            .navbar-brand {
                font-weight: 700;
                font-size: 1.8rem;
                color: var(--primary);
            }

            .nav-link {
                font-weight: 500;
                color: var(--dark);
                /* margin: 0 10px; */
                position: relative;
            }

            .nav-link:after {
                content: '';
                position: absolute;
                width: 0;
                height: 2px;
                background: var(--primary);
                bottom: -3px;
                left: 0;
                transition: width 0.3s ease;
            }

            .nav-link:hover:after {
                width: 100%;
            }

            .hero {
                min-height: 100vh;
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.7) 100%), url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cpath fill='%231a73e8' fill-opacity='0.05' d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z'%3E%3C/path%3E%3C/svg%3E");
                display: flex;
                align-items: center;
                position: relative;
            }

            .hero-content {
                padding: 80px 0;
            }

            .hero-title {
                font-size: 3rem;
                font-weight: 700;
                margin-bottom: 20px;
                color: var(--dark);
            }

            .hero-subtitle {
                font-size: 1.2rem;
                margin-bottom: 30px;
                color: #555;
                line-height: 1.6;
            }

            .hero-image {
                position: relative;
            }

            .hero-image img {
                border-radius: 10px;
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            }

            .feature-card {
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
                height: 100%;
                background-color: white;
            }

            .feature-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }

            .feature-icon {
                width: 60px;
                height: 60px;
                background-color: var(--light);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 20px;
                color: var(--primary);
                font-size: 1.5rem;
            }

            .property-card {
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
                margin-bottom: 30px;
                background-color: white;
            }

            .property-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }

            .property-image {
                height: 200px;
                background-size: cover;
                background-position: center;
            }

            .property-badge {
                position: absolute;
                top: 15px;
                right: 15px;
                background-color: var(--primary);
                color: white;
                padding: 5px 10px;
                border-radius: 5px;
                font-size: 0.8rem;
                font-weight: 600;
            }

            .property-content {
                padding: 20px;
            }

            .property-title {
                font-size: 1.2rem;
                font-weight: 600;
                margin-bottom: 10px;
            }

            .property-location {
                color: #777;
                font-size: 0.9rem;
                margin-bottom: 15px;
                display: flex;
                align-items: center;
            }

            .property-location i {
                margin-right: 5px;
                color: var(--primary);
            }

            .property-features {
                display: flex;
                justify-content: space-between;
                margin-bottom: 15px;
                font-size: 0.9rem;
            }

            .property-feature {
                display: flex;
                align-items: center;
            }

            .property-feature i {
                margin-right: 5px;
                color: var(--primary);
            }

            .property-price {
                font-size: 1.2rem;
                font-weight: 700;
                color: var(--primary);
                margin-bottom: 15px;
            }

            .property-price span {
                font-size: 0.9rem;
                font-weight: 400;
                color: #777;
            }

            .testimonial-card {
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                background-color: white;
                margin-bottom: 30px;
                position: relative;
            }

            .testimonial-card:before {
                content: '"';
                position: absolute;
                top: 10px;
                left: 20px;
                font-size: 5rem;
                color: rgba(26, 115, 232, 0.1);
                font-family: serif;
                line-height: 1;
            }

            .testimonial-content {
                font-style: italic;
                margin-bottom: 20px;
                position: relative;
                z-index: 1;
            }

            .testimonial-author {
                display: flex;
                align-items: center;
            }

            .testimonial-avatar {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                overflow: hidden;
                margin-right: 15px;
                background-color: var(--light);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--primary);
                font-weight: 700;
                font-size: 1.2rem;
            }

            .testimonial-info h5 {
                margin-bottom: 5px;
                font-weight: 600;
            }

            .testimonial-info p {
                color: #777;
                font-size: 0.9rem;
                margin: 0;
            }

            .cta-section {
                background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
                padding: 80px 0;
                color: white;
                border-radius: 10px;
                margin: 50px 0;
            }

            .cta-title {
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 20px;
            }

            .cta-subtitle {
                font-size: 1.1rem;
                margin-bottom: 30px;
                opacity: 0.9;
            }

            .btn-light-custom {
                background-color: white;
                color: var(--primary);
                padding: 12px 30px;
                border-radius: 6px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-light-custom:hover {
                background-color: var(--light);
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2);
            }

            footer {
                background-color: var(--dark);
                color: white;
                padding: 60px 0 20px;
            }

            .footer-title {
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 20px;
                color: white;
            }

            .footer-links {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .footer-links li {
                margin-bottom: 10px;
            }

            .footer-links a {
                color: rgba(255, 255, 255, 0.7);
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .footer-links a:hover {
                color: white;
                padding-left: 5px;
            }

            .footer-contact {
                display: flex;
                align-items: center;
                margin-bottom: 15px;
                color: rgba(255, 255, 255, 0.7);
            }

            .footer-contact i {
                margin-right: 10px;
                color: var(--primary);
            }

            .footer-social {
                display: flex;
                margin-top: 20px;
            }

            .footer-social a {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background-color: rgba(255, 255, 255, 0.1);
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 10px;
                color: white;
                transition: all 0.3s ease;
            }

            .footer-social a:hover {
                background-color: var(--primary);
                transform: translateY(-3px);
            }

            .copyright {
                text-align: center;
                padding-top: 30px;
                margin-top: 30px;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                color: rgba(255, 255, 255, 0.5);
                font-size: 0.9rem;
            }

            /* Filter Styles */
            .filter-container {
                background-color: white;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                margin-bottom: 30px;
            }

            .filter-title {
                font-size: 1.2rem;
                font-weight: 600;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 1px solid #eee;
            }

            .form-label {
                font-weight: 500;
                color: var(--dark);
            }

            .form-control,
            .form-select {
                border-radius: 6px;
                padding: 10px 15px;
                border: 1px solid #e0e0e0;
            }

            .form-control:focus,
            .form-select:focus {
                box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
                border-color: var(--primary);
            }

            .form-check-input:checked {
                background-color: var(--primary);
                border-color: var(--primary);
            }

            /* Property Detail Styles */
            .property-gallery {
                margin-bottom: 30px;
            }

            .property-main-image {
                height: 400px;
                background-size: cover;
                background-position: center;
                border-radius: 10px;
                margin-bottom: 15px;
            }

            .property-thumbnail {
                height: 100px;
                background-size: cover;
                background-position: center;
                border-radius: 5px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .property-thumbnail:hover {
                opacity: 0.8;
            }

            .property-detail-title {
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 10px;
            }

            .property-detail-location {
                color: #777;
                font-size: 1rem;
                margin-bottom: 20px;
                display: flex;
                align-items: center;
            }

            .property-detail-location i {
                margin-right: 5px;
                color: var(--primary);
            }

            .property-detail-price {
                font-size: 1.8rem;
                font-weight: 700;
                color: var(--primary);
                margin-bottom: 20px;
            }

            .property-detail-price span {
                font-size: 1rem;
                font-weight: 400;
                color: #777;
            }

            .property-detail-features {
                display: flex;
                flex-wrap: wrap;
                margin-bottom: 30px;
            }

            .property-detail-feature {
                display: flex;
                align-items: center;
                margin-right: 30px;
                margin-bottom: 15px;
            }

            .property-detail-feature i {
                margin-right: 10px;
                color: var(--primary);
                font-size: 1.2rem;
            }

            .property-detail-description {
                margin-bottom: 30px;
                line-height: 1.8;
            }

            .property-detail-amenities {
                margin-bottom: 30px;
            }

            .property-detail-amenity {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
            }

            .property-detail-amenity i {
                margin-right: 10px;
                color: var(--primary);
            }

            .booking-form {
                background-color: white;
                border-radius: 10px;
                padding: 30px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            }

            .booking-form-title {
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 1px solid #eee;
            }

            /* Dashboard Styles */
            .dashboard-card {
                background-color: white;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                margin-bottom: 30px;
                height: 100%;
            }

            .dashboard-card-title {
                font-size: 1.2rem;
                font-weight: 600;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 1px solid #eee;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .dashboard-card-title .badge {
                font-size: 0.8rem;
                padding: 5px 10px;
            }

            .dashboard-stat {
                text-align: center;
                padding: 20px;
            }

            .dashboard-stat-value {
                font-size: 2.5rem;
                font-weight: 700;
                color: var(--primary);
                margin-bottom: 10px;
            }

            .dashboard-stat-label {
                color: #777;
                font-size: 1rem;
            }

            .dashboard-table th {
                font-weight: 600;
                color: var(--dark);
            }

            .dashboard-table td {
                vertical-align: middle;
            }

            .sidebar {
                background-color: white;
                border-radius: 10px;
                padding: 30px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                position: sticky;
                top: 100px;
            }

            .sidebar-title {
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 1px solid #eee;
            }

            .sidebar-menu {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .sidebar-menu li {
                margin-bottom: 10px;
            }

            .sidebar-menu a {
                display: flex;
                align-items: center;
                padding: 10px 15px;
                border-radius: 6px;
                text-decoration: none;
                color: var(--dark);
                transition: all 0.3s ease;
            }

            .sidebar-menu a:hover,
            .sidebar-menu a.active {
                background-color: var(--light);
                color: var(--primary);
            }

            .sidebar-menu a i {
                margin-right: 10px;
            }

            /* Admin Panel Styles */
            .admin-header {
                background-color: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                margin-bottom: 30px;
            }

            .admin-title {
                font-size: 1.8rem;
                font-weight: 700;
                margin-bottom: 0;
            }

            .admin-breadcrumb {
                margin-bottom: 0;
            }

            .admin-card {
                background-color: white;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                margin-bottom: 30px;
            }

            .admin-card-title {
                font-size: 1.2rem;
                font-weight: 600;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 1px solid #eee;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            /* Responsive Adjustments */
            @media (max-width: 991.98px) {
                .hero-title {
                    font-size: 2.5rem;
                }

                .property-main-image {
                    height: 300px;
                }

                .property-thumbnail {
                    height: 80px;
                }

                .sidebar {
                    position: static;
                    margin-bottom: 30px;
                }
            }

            @media (max-width: 767.98px) {
                .hero-title {
                    font-size: 2rem;
                }

                .cta-title {
                    font-size: 2rem;
                }

                .property-main-image {
                    height: 250px;
                }

                .property-thumbnail {
                    height: 60px;
                }

                .property-detail-title {
                    font-size: 1.5rem;
                }

                .property-detail-price {
                    font-size: 1.5rem;
                }
            }

            @media (max-width: 575.98px) {
                .hero-title {
                    font-size: 1.8rem;
                }

                .hero-subtitle {
                    font-size: 1rem;
                }

                .cta-title {
                    font-size: 1.8rem;
                }

                .cta-subtitle {
                    font-size: 1rem;
                }

                .property-main-image {
                    height: 200px;
                }

                .property-thumbnail {
                    height: 50px;
                }
            }

            /* Animation Styles */
            .fade-in {
                animation: fadeIn 0.5s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .pulse {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.05);
                }

                100% {
                    transform: scale(1);
                }
            }

            /* Custom Scrollbar */
            ::-webkit-scrollbar {
                width: 10px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            ::-webkit-scrollbar-thumb {
                background: var(--primary);
                border-radius: 5px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: var(--primary-dark);
            }
        </style>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"
            rel="stylesheet">
        <link type="text/css" rel="stylesheet" id="dark-mode-custom-link">
        <link type="text/css" rel="stylesheet" id="dark-mode-general-link">
        <style lang="en" type="text/css" id="dark-mode-custom-style"></style>
        <style lang="en" type="text/css" id="dark-mode-native-style"></style>
        <style lang="en" type="text/css" id="dark-mode-native-sheet"></style>

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
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h3 class="footer-title">E-Kost</h3>
                        <p class="text-white-50 mb-4">Platform terintegrasi untuk pencarian, booking, dan manajemen
                            kost
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
                            <li><a href="listing.html">Cari Kost</a></li>
                            <li><a href="#">Tentang Kami</a></li>
                            <li><a href="#">Kontak</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
                        <h5 class="footer-title">Layanan</h5>
                        <ul class="footer-links">
                            <li><a href="#">Pencarian Kost</a></li>
                            <li><a href="#">Booking Online</a></li>
                            <li><a href="#">Manajemen Kost</a></li>
                            <li><a href="#">Pembayaran</a></li>
                            <li><a href="#">Bantuan</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="footer-title">Kontak</h5>
                        <div class="footer-contact">
                            <i class="bi bi-geo-alt"></i>
                            <span>Jl. Sudirman No. 123, Jakarta Pusat</span>
                        </div>
                        <div class="footer-contact">
                            <i class="bi bi-telephone"></i>
                            <span>+62 21 1234 5678</span>
                        </div>
                        <div class="footer-contact">
                            <i class="bi bi-envelope"></i>
                            <span>info@e-kost.id</span>
                        </div>
                        <div class="footer-contact">
                            <i class="bi bi-clock"></i>
                            <span>Senin - Jumat: 09:00 - 17:00</span>
                        </div>
                    </div>
                </div>
                <div class="copyright">
                    <p>© 2023 E-Kost. All Rights Reserved.</p>
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
                                <h1 class="admin-title">Cari Kost</h1>
                            </div>
                            <div class="col-md-6">
                                <nav aria-label="breadcrumb">
                                    <ol class="admin-breadcrumb breadcrumb justify-content-md-end">
                                        <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Cari Kost</li>
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
                                        <label class="form-label">Tipe Kost</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="type-putra">
                                            <label class="form-check-label" for="type-putra">
                                                Kost Putra
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="type-putri">
                                            <label class="form-check-label" for="type-putri">
                                                Kost Putri
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="type-campur">
                                            <label class="form-check-label" for="type-campur">
                                                Kost Campur
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
                                        <input type="text" class="form-control" placeholder="Cari kost...">
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
                                            style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'200\' viewBox=\'0 0 400 200\'><rect width=\'400\' height=\'200\' fill=\'%234fc3f7\' opacity=\'0.3\'/><rect x=\'50\' y=\'50\' width=\'300\' height=\'100\' fill=\'%231a73e8\' opacity=\'0.5\'/><text x=\'200\' y=\'110\' font-family=\'Arial\' font-size=\'20\' text-anchor=\'middle\' fill=\'%23ffffff\'>Kost Nyaman</text></svg>');">
                                            <div class="property-badge">Populer</div>
                                        </div>
                                        <div class="property-content">
                                            <h5 class="property-title">Kost Nyaman Menteng</h5>
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
                                <h1 class="admin-title">Detail Kost</h1>
                            </div>
                            <div class="col-md-6">
                                <nav aria-label="breadcrumb">
                                    <ol class="admin-breadcrumb breadcrumb justify-content-md-end">
                                        <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                                        <li class="breadcrumb-item"><a href="listing.html">Cari Kost</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Detail Kost</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="property-gallery">
                                <div class="property-main-image"
                                    style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'800\' height=\'400\' viewBox=\'0 0 800 400\'><rect width=\'800\' height=\'400\' fill=\'%234fc3f7\' opacity=\'0.3\'/><rect x=\'100\' y=\'100\' width=\'600\' height=\'200\' fill=\'%231a73e8\' opacity=\'0.5\'/><text x=\'400\' y=\'210\' font-family=\'Arial\' font-size=\'30\' text-anchor=\'middle\' fill=\'%23ffffff\'>Kost Nyaman Menteng</text></svg>');">
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
                                <h2 class="property-detail-title">Kost Nyaman Menteng</h2>
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
                                        <span>Tipe: Kost Putri</span>
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
                                    <p>Kost Nyaman Menteng menawarkan hunian yang strategis di pusat kota Jakarta.
                                        Dengan
                                        akses mudah ke berbagai fasilitas umum seperti pusat perbelanjaan, rumah sakit,
                                        dan
                                        transportasi umum, kost ini sangat ideal untuk mahasiswa dan profesional muda.
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
