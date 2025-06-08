<?php

use App\Models\BoardingHouse;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};

name("catalog.show");

state(["boardingHouse"]);
?>

<x-guest-layout>
    @include("components.partials.fancybox")

    @volt
        <div class="container py-5">
            <!-- Header & Image -->
            <div class="row g-4 align-items-start">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <img src="{{ $boardingHouse->thumbnail ? Storage::url($boardingHouse->thumbnail) : "data:image/svg+xml;charset=UTF-8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'200\' viewBox=\'0 0 400 200\'><rect width=\'400\' height=\'200\' fill=\'%234fc3f7\' opacity=\'0.3\'/><rect x=\'50\' y=\'50\' width=\'300\' height=\'100\' fill=\'%231a73e8\' opacity=\'0.5\'/><text x=\'200\' y=\'110\' font-family=\'Arial\' font-size=\'20\' text-anchor=\'middle\' fill=\'%23ffffff\'>Kost Nyaman</text></svg>" }}"
                            alt="Foto Kos" class="card-img-top rounded-top-4" style="object-fit: cover; height: 400px;">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <div class="mb-3">
                            <span class="badge bg-success me-2">{{ __("category." . $boardingHouse->category) }}</span>
                            <span
                                class="badge {{ $boardingHouse->verification_status === "verified" ? "bg-primary" : "bg-warning text-dark" }}">
                                {{ __("verification_status." . $boardingHouse->verification_status) }}
                            </span>
                        </div>

                        <h2 class="fw-bold mb-2">{{ $boardingHouse->name }}</h2>
                        <p class="text-muted mb-2">
                            <i class="bi bi-geo-alt me-1 text-danger"></i>{{ $boardingHouse->address }}
                        </p>
                        <!-- Redirect to Google Maps Location -->
                        @if ($boardingHouse->location_map)
                            <p class="text-muted mb-2">
                                <a href="{{ $boardingHouse->location_map }}" target="_blank" class="text-decoration-none">
                                    <i class="bi bi-map me-1 text-danger"></i> Lihat di Google Maps
                                </a>
                            </p>
                        @else
                            <p class="text-muted mb-2">
                                Peta tidak tersedia
                            </p>
                        @endif

                        <div class="mb-2">
                            <h6 class="fw-semibold mb-1">Pemilik</h6>
                            <p class="mb-0">{{ $boardingHouse->owner->name ?? "Tidak diketahui" }}</p>
                        </div>

                        <div class="mt-4 d-flex gap-3">
                            <a href="https://wa.me/{{ $boardingHouse->owner->whatsapp_number }}" class="btn btn-dark w-100">
                                <i class="fas fa-bed me-1"></i> Hubungi Pemilik
                            </a>
                            <a href="#rooms" class="btn btn-secondary w-100">
                                <i class="fas fa-bed me-1"></i> Lihat Kamar
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Facilities -->
            <div class="mt-5">
                <h4 class="fw-bold mb-3">Fasilitas Kos</h4>
                <div class="bg-light rounded-4 p-4 shadow-sm">
                    @forelse($boardingHouse->facilities as $facility)
                        <span class="badge bg-primary me-2 mb-3 mb-md-0 p-2">{{ $facility->name }}</span>
                    @empty
                        <p class="text-muted">Tidak ada fasilitas tersedia.</p>
                    @endforelse
                </div>
            </div>

            <!-- House Rules -->
            <div class="mt-5">
                <h4 class="fw-bold mb-3">Aturan Kos</h4>
                @forelse($boardingHouse->regulations as $regulation)
                    <div class="d-flex align-items-start mb-2">
                        <i class="bi bi-dot text-primary me-2 fs-5 mt-1"></i>
                        <p class="mb-0">{{ Str::headline($regulation->rule) }}</p>
                    </div>
                @empty
                    <p class="text-muted">Belum ada aturan yang ditetapkan.</p>
                @endforelse
            </div>

            <!-- Gallery -->
            @if ($boardingHouse->galleries && count($boardingHouse->galleries))
                <div class="mt-5">
                    <h4 class="fw-bold mb-3">Galeri Foto</h4>
                    <div class="row g-3">
                        @foreach ($boardingHouse->galleries as $gallery)
                            <div class="col-6 col-md-3 ">
                                <div class="card border-0 shadow-sm rounded-4">
                                    <!-- Menambahkan fancybox pada gambar -->
                                    <a href="{{ Storage::url($gallery->image) }}" data-fancybox="gallery"
                                        data-caption="Foto Galeri">
                                        <img src="{{ Storage::url($gallery->image) }}" class="img-fluid rounded-4"
                                            alt="Foto Galeri" style="object-fit: cover; height: 180px; width: 100%;">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <!-- Room List -->
            <div id="rooms" class="mt-5">
                <h4 class="fw-bold mb-3">Tipe & Harga Kamar</h4>
                @forelse($boardingHouse->rooms as $room)
                    <div class="card border shadow-sm mb-3 rounded-4 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Kamar No. {{ $room->room_number }}</h5>
                                <p class="mb-0 text-muted">Ukuran: {{ $room->size }} m<sup>2</sup></p>
                                <small class="text-muted">Status:
                                    <span class="text-{{ $room->status === "available" ? "success" : "danger" }}">
                                        {{ __("room_status." . $room->status) }}
                                    </span>
                                </small>
                            </div>
                            <div>
                                <p class="fw-bold fs-5 text-primary">{{ formatRupiah($room->price) }}/bulan</p>
                                <!-- WhatsApp Link -->
                                @if ($room->status === "available" && Auth::check())
                                    <div class="mt-3">
                                        <a href="https://wa.me/{{ $boardingHouse->owner->whatsapp_number }}?text=Halo%2C%20saya%20ingin%20memesan%20kamar%20kos%20dengan%20detail%20sebagai%20berikut%3A%0A%0A%2A%2A%2A%20Kamar%20Kos%20Detail%20%2A%2A%2A%0A%0A%2D%20*Kamar%20No*:%20No.%20{{ $room->room_number }}%0A%2D%20*Ukuran*: {{ $room->size }}m%5E2%0A%2D%20*Harga*: {{ formatRupiah($room->price) }}%2Fbulan%0A%2D%20*Status*: {{ __("room_status." . $room->status) }}%0A%0A%2A%2A%2A%20Detail%20Pengguna%20%2A%2A%2A%0A%0A%2D%20*Nama*: {{ auth()->user()->name }}%0A%2D%20*Email*: {{ auth()->user()->email }}%0A%2D%20*Nomor%20Telepon*: {{ auth()->user()->phone_number }}%0A%2D%20*Alamat*: {{ auth()->user()->address ?? "Tidak tersedia" }}"
                                            class="btn btn-outline-dark btn-sm w-100" target="_blank">
                                            <i class="bi bi-chat-left-dots me-1"></i> Pesan Kamar
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                @empty
                    <p class="text-muted">Belum ada kamar terdaftar.</p>
                @endforelse
            </div>

        </div>
    @endvolt
</x-guest-layout>
