<?php

use App\Models\BoardingHouse;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};

name("welcome");

state([
    "boardingHouses" => fn() => BoardingHouse::where("verification_status", "verified")->limit(6)->get(),
]);
?>

<x-guest-layout>

    @volt
        <div>
            <!-- Hero Section -->
            <section class="hero" id="home">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 hero-content">
                            <h1 class="hero-title fade-in">Temukan Kos Ideal Anda dengan Kemudahan Digital</h1>
                            <p class="hero-subtitle fade-in">Platform terintegrasi untuk pencarian, booking, dan manajemen
                                kos
                                secara online. Temukan hunian nyaman sesuai kebutuhan Anda.</p>
                            <div class="d-flex flex-wrap gap-3 fade-in">
                                <a href="{{ route("catalog.listing") }}" class="btn btn-primary-custom">Cari Kos Sekarang</a>
                                <a href="{{ route("register") }}" class="btn btn-outline-primary-custom">Daftarkan Kos
                                    Anda</a>
                            </div>
                        </div>
                        <div class="col-lg-6 hero-image mt-5 mt-lg-0">
                            <svg class="img-fluid" viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                                <rect x="50" y="50" width="400" height="300" rx="10" fill="#f5f9ff"
                                    stroke="#1a73e8" stroke-width="2"></rect>
                                <rect x="70" y="70" width="360" height="200" rx="5" fill="#ffffff"
                                    stroke="#1a73e8" stroke-width="1"></rect>
                                <rect x="90" y="90" width="150" height="100" rx="5" fill="#1a73e8"
                                    opacity="0.1">
                                </rect>
                                <rect x="260" y="90" width="150" height="100" rx="5" fill="#1a73e8"
                                    opacity="0.2">
                                </rect>
                                <rect x="90" y="210" width="320" height="40" rx="5" fill="#1a73e8"
                                    opacity="0.15">
                                </rect>
                                <rect x="70" y="290" width="100" height="40" rx="20" fill="#1a73e8"></rect>
                                <text x="120" y="315" text-anchor="middle" fill="white" font-family="Arial" font-size="14"
                                    font-weight="bold">Cari</text>
                                <circle cx="400" cy="80" r="10" fill="#1a73e8"></circle>
                                <circle cx="430" cy="80" r="10" fill="#4fc3f7"></circle>
                                <path d="M150 140 L180 120 L210 150 L240 110" stroke="#1a73e8" stroke-width="2"
                                    fill="none">
                                </path>
                                <rect x="270" y="110" width="130" height="10" rx="5" fill="#1a73e8"
                                    opacity="0.3"></rect>
                                <rect x="270" y="130" width="100" height="10" rx="5" fill="#1a73e8"
                                    opacity="0.3"></rect>
                                <rect x="270" y="150" width="80" height="10" rx="5" fill="#1a73e8"
                                    opacity="0.3"></rect>
                                <rect x="270" y="170" width="110" height="10" rx="5" fill="#1a73e8"
                                    opacity="0.3"></rect>
                            </svg>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="py-5 bg-light-custom">
                <div class="container py-5">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold mb-3">Mengapa Memilih E-Kos?</h2>
                        <p class="text-muted mx-auto" style="max-width: 600px;">Platform kami menawarkan kemudahan dan
                            kenyamanan dalam mencari dan mengelola kos dengan fitur-fitur terbaik.</p>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="bi bi-search"></i>
                                </div>
                                <h4 class="mb-3">Pencarian Mudah</h4>
                                <p class="text-muted">Temukan kos ideal dengan filter lokasi, harga, dan fasilitas sesuai
                                    kebutuhan Anda.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <h4 class="mb-3">Terpercaya</h4>
                                <p class="text-muted">Semua kos telah diverifikasi untuk memastikan kenyamanan dan
                                    keamanan
                                    penghuni.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="bi bi-credit-card"></i>
                                </div>
                                <h4 class="mb-3">Pembayaran Aman</h4>
                                <p class="text-muted">Proses pembayaran yang aman dan transparan dengan berbagai metode
                                    pembayaran.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <h4 class="mb-3">Lokasi Strategis</h4>
                                <p class="text-muted">Pilihan kos dengan lokasi strategis dekat kampus, perkantoran, dan
                                    fasilitas umum.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="bi bi-house-door"></i>
                                </div>
                                <h4 class="mb-3">Beragam Pilihan</h4>
                                <p class="text-muted">Tersedia berbagai tipe kos dari ekonomis hingga premium sesuai
                                    budget
                                    Anda.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="bi bi-chat-dots"></i>
                                </div>
                                <h4 class="mb-3">Dukungan 24/7</h4>
                                <p class="text-muted">Tim dukungan kami siap membantu Anda kapan saja dan di mana saja.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Featured Properties Section -->
            <section class="py-5">
                <div class="container py-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div>
                            <h2 class="fw-bold mb-2">Kos Unggulan</h2>
                            <p class="text-muted">Temukan pilihan kos terbaik dan terpopuler</p>
                        </div>
                        <a href="{{ route("catalog.listing") }}" class="btn btn-outline-primary-custom">Lihat Semua</a>
                    </div>
                    <div class="row">
                        @foreach ($boardingHouses as $item)
                            <div class="col-md-6 col-lg-4">
                                <div class="property-card">
                                    <div class="property-image"
                                        style="background-image: url('{{ $item->thumbnail ? Storage::url($item->thumbnail) : "data:image/svg+xml;charset=UTF-8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'200\' viewBox=\'0 0 400 200\'><rect width=\'400\' height=\'200\' fill=\'%234fc3f7\' opacity=\'0.3\'/><rect x=\'50\' y=\'50\' width=\'300\' height=\'100\' fill=\'%231a73e8\' opacity=\'0.5\'/><text x=\'200\' y=\'110\' font-family=\'Arial\' font-size=\'20\' text-anchor=\'middle\' fill=\'%23ffffff\'>Kos Nyaman</text></svg>" }}');">
                                        <div class="property-badge">
                                            {{ __("category." . $item->category) }}
                                        </div>
                                    </div>
                                    <div class="property-content">
                                        <h5 class="property-title">{{ Str::limit($item->name, "30", "...") }}</h5>
                                        <div class="property-location">
                                            <i class="bi bi-geo-alt"></i>
                                            <span>{{ Str::limit($item->address, "40", "...") }}</span>
                                        </div>

                                        <div class="property-features">
                                            <div class="property-feature">
                                                <i class="bi bi-rulers"></i>
                                                <span>{{ $item->rooms->first()->size ?? "-" }} m²</span>
                                            </div>
                                            <div class="property-feature">
                                                <i class="bi bi-lightning"></i>
                                                <span>{{ $item->facilities->first()->name ?? "-" }}</span>
                                            </div>
                                            <div class="property-feature">
                                                <i class="bi bi-house-door"></i>
                                                <span>{{ $item->rooms->count() ?? "-" }} Kamar</span>
                                            </div>
                                        </div>
                                        <div class="property-price">
                                            Rp 1.500.000 <span>/ bulan</span>
                                        </div>
                                        <a href="{{ route("catalog.show", ["boardingHouse" => $item]) }}"
                                            class="btn btn-primary-custom w-100">Lihat
                                            Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>

            <!-- Testimonials Section -->
            <section class="py-5 bg-light-custom">
                <div class="container py-5">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold mb-3">Apa Kata Mereka?</h2>
                        <p class="text-muted mx-auto" style="max-width: 600px;">Pengalaman pengguna yang telah menggunakan
                            layanan E-Kos untuk menemukan hunian ideal mereka.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="testimonial-card">
                                <p class="testimonial-content">"Berkat E-Kos, saya menemukan kos yang nyaman dan
                                    terjangkau
                                    dekat dengan kampus saya. Proses pencarian dan bookingnya sangat mudah!"</p>
                                <div class="testimonial-author">
                                    <div class="testimonial-avatar">
                                        AS
                                    </div>
                                    <div class="testimonial-info">
                                        <h5>Andi Saputra</h5>
                                        <p>Mahasiswa, Jakarta</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="testimonial-card">
                                <p class="testimonial-content">"Sebagai pemilik kos, E-Kos membantu saya mengelola
                                    properti
                                    dengan lebih efisien. Sistem pembayaran yang aman dan transparan sangat membantu."</p>
                                <div class="testimonial-author">
                                    <div class="testimonial-avatar">
                                        RD
                                    </div>
                                    <div class="testimonial-info">
                                        <h5>Ratna Dewi</h5>
                                        <p>Pemilik Kos, Bandung</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="testimonial-card">
                                <p class="testimonial-content">"Fitur filter pencarian sangat membantu saya menemukan kos
                                    yang
                                    sesuai dengan budget dan kebutuhan. Foto dan deskripsi yang detail membuat saya tidak
                                    perlu
                                    survei langsung."</p>
                                <div class="testimonial-author">
                                    <div class="testimonial-avatar">
                                        BP
                                    </div>
                                    <div class="testimonial-info">
                                        <h5>Budi Pratama</h5>
                                        <p>Karyawan, Surabaya</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-5">
                <div class="container">
                    <div class="cta-section">
                        <div class="row align-items-center mx-5">
                            <div class="col-lg-8 text-center text-lg-start">
                                <h2 class="cta-title">Siap Menemukan Kos Ideal Anda?</h2>
                                <p class="cta-subtitle">Bergabunglah dengan ribuan pengguna yang telah menemukan hunian
                                    nyaman
                                    melalui platform kami.</p>
                            </div>
                            <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0">
                                <a href="{{ route("catalog.listing") }}" class="btn btn-light btn-lg me-2">Cari Kos</a>
                                <a href="{{ route("register") }}" class="btn btn-outline-light btn-lg">Daftar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endvolt
</x-guest-layout>
