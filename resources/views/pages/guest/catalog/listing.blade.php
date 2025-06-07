<?php

use App\Models\BoardingHouse;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};

name("catalog.listing");

state([
    "boardingHouses" => fn() => BoardingHouse::where("verification_status", "verified")->get(),
]);
?>

<x-guest-layout>

    @volt
        <div>
            <main class="container py-5">
                <div class="row g-5">

                    <aside class="col-lg-4">
                        <div class="p-4 shadow-sm rounded-3 bg-light pt-5">
                            <h4 class="fw-bold mb-4">Filter Pencarian</h4>

                            <div class="mb-4">
                                <label for="sort" class="form-label fw-semibold">Urutkan Berdasarkan</label>
                                <select class="form-select" id="sort">
                                    <option selected>Relevansi</option>
                                    <option value="price_asc">Harga Termurah</option>
                                    <option value="price_desc">Harga Termahal</option>
                                    <option value="newest">Terbaru</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="priceRange" class="form-label fw-semibold">Rentang Harga</label>
                                <input type="range" class="form-range" min="0" max="5000000" step="100000"
                                    id="priceRange">
                                <div class="d-flex justify-content-between text-muted small mt-1">
                                    <span>Rp 0</span>
                                    <span>Rp 5.000.000+</span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-semibold">Tipe Kost</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="typePutra">
                                    <label class="form-check-label" for="typePutra">Putra</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="typePutri">
                                    <label class="form-check-label" for="typePutri">Putri</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="typeCampur" checked>
                                    <label class="form-check-label" for="typeCampur">Campur</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-semibold">Fasilitas</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="fasilitasAC" checked>
                                    <label class="form-check-label" for="fasilitasAC">AC</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="fasilitasKM">
                                    <label class="form-check-label" for="fasilitasKM">Kamar Mandi Dalam</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="fasilitasWifi"
                                        checked>
                                    <label class="form-check-label" for="fasilitasWifi">Wi-Fi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="fasilitasParkir">
                                    <label class="form-check-label" for="fasilitasParkir">Parkir Mobil</label>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg" type="button">
                                    <i class="fas fa-filter me-2">
                                    </i>Terapkan Filter
                                </button>
                            </div>
                        </div>
                    </aside>

                    <section class="col-lg-8 pt-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-bold mb-0">Hasil Pencarian</h3>
                            <p class="text-muted mb-0">Menampilkan 1-5 dari 28 kost</p>
                        </div>

                        @foreach ($boardingHouses as $item)
                            <div class="card kost-card mb-4 shadow-sm">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ $item->thumbnail ? Storage::url($item->thumbnail) : "data:image/svg+xml;charset=UTF-8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'200\' viewBox=\'0 0 400 200\'><rect width=\'400\' height=\'200\' fill=\'%234fc3f7\' opacity=\'0.3\'/><rect x=\'50\' y=\'50\' width=\'300\' height=\'100\' fill=\'%231a73e8\' opacity=\'0.5\'/><text x=\'200\' y=\'110\' font-family=\'Arial\' font-size=\'20\' text-anchor=\'middle\' fill=\'%23ffffff\'>Kost Nyaman</text></svg>" }}"
                                            class="img-fluid rounded-start h-100" alt="Kamar Kost"
                                            style="object-fit: cover;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body d-flex flex-column h-100">
                                            <div class="mb-2">
                                                <span class="badge bg-success">Tersedia</span>
                                                <span class="badge bg-info">{{ __("category." . $item->category) }}</span>
                                            </div>
                                            <h5 class="card-title fw-bold">{{ $item->name }}</h5>
                                            <p class="card-text text-muted small mb-2">
                                                <i class="bi bi-geo-alt me-2">

                                                </i>
                                                {{ $item->address }}
                                            </p>
                                            <div class="d-flex text-muted small mb-3 gap-1">
                                                @foreach ($item->facilities->take(3) as $facility)
                                                    <span class="badge bg-primary p-2">
                                                        {{ $facility->name }}
                                                    </span>
                                                @endforeach
                                                <span class="badge bg-primary p-2">
                                                    ...
                                                </span>

                                            </div>
                                            <div class="mt-auto">
                                                <p class="card-text mb-1">
                                                    <small class="text-muted">Mulai dari</small>
                                                </p>
                                                <h5 class="fw-bold text-primary mb-0">
                                                    {{ formatRupiah($item->rooms->first()->price ?? "0") }} /
                                                    bulan</h5>
                                            </div>
                                            <a href="{{ route("catalog.show", ["boardingHouse" => $item]) }}"
                                                class="btn btn-outline-primary stretched-link mt-3">
                                                Lihat
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <nav aria-label="Page navigation" class="mt-5">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"
                                        aria-disabled="true">Sebelumnya</a>
                                </li>
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Selanjutnya</a>
                                </li>
                            </ul>
                        </nav>

                    </section>
                </div>
        </div>
    @endvolt

</x-guest-layout>
