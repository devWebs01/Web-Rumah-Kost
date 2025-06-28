<?php

use App\Models\{BoardingHouse, Facility};
use function Livewire\Volt\{state, computed, usesPagination};
use function Laravel\Folio\{name};

usesPagination(theme: "bootstrap");

name("catalog.listing");

state([
    "availableFacilities" => fn() => Facility::get(),
    "sort" => "",
    "search" => "",
    "category" => [], // array of kategori tipe id (Putra, Putri, Campur)
    "facilities" => [], // array of fasilitas id
    "all_facilities" => ["AC", "Kamar Mandi Dalam", "Wi-Fi", "Parkir Mobil", "Balkon", "CCTV", "Dapur", "Dispenser", "Duplikat Gerbang Kos", "Gazebo", "Jemuran", "Joglo", "Jual Makanan", "K Mandi Luar", "Kamar Mandi Luar - WC Duduk", "Kamar Mandi Luar - WC Jongkok", "Kartu Akses", "Kompor", "Kulkas", "Laundry", "Loker", "Mesin Cuci", "Mushola", "Pengurus Kos", "Penjaga Kos", "R. Cuci", "R. Jemur", "R. Keluarga", "R. Makan", "R. Santai", "R. Tamu", "Rice Cooker", "Rooftop", "TV", "Taman", "WIFI"], // array of fasilitas id
]);

// Untuk dropdown filter dinamis (jika perlu)

$boardingHouses = computed(function () {
    $query = BoardingHouse::query()
        ->where("verification_status", "verified") // tampilkan hanya kos yang diverifikasi
        ->with(["rooms", "facilities"]); // eager load

    // Filter kategori/tipenya
    if (!empty($this->category)) {
        // diasumsikan category_id sesuai id dari kategori tipe (putra, putri, campur)
        $query->whereIn("category", $this->category);
    }
    // Filter search
    if (!empty($this->search)) {
        // diasumsikan search pencarian nama kos
        $query->where("name", "like", "%" . $this->search . "%");
    }

    // Filter fasilitas
    if (!empty($this->facilities)) {
        $facilityCount = count($this->facilities);

        $query->whereHas(
            "facilities",
            function ($q): void {
                $q->whereIn("name", $this->facilities);
            },
            ">=",
            $facilityCount,
        ); // Jumlah minimal fasilitas yang harus dimiliki
    }

    // Urutan
    switch ($this->sort) {
        case "price_asc":
            $query->withMin("rooms", "price")->orderBy("created_at", "asc");
            break;
        case "price_desc":
            $query->withMin("rooms", "price")->orderBy("created_at", "desc");
            break;
        case "newest":
            $query->orderBy("created_at", "desc");
            break;
        default:
            $query->latest();
    }

    return $query->paginate(5);
});
?>

<x-guest-layout>

    @volt
        <div>
            {{-- @dd($all_facilities); --}}
            <main class="container py-5">
                <div class="row g-5">
                    <aside class="col-lg-4">
                        <div class="p-4 shadow-sm border rounded-3 bg-light pt-5">
                            <h4 class="fw-bold mb-4">Filter Pencarian </h4>

                            <div class="mb-3">
                                <label for="sort" class="form-label fw-semibold">Pencarian Nama Kos</label>

                                <input type="search" class="form-control" wire:model.live="search" aria-describedby="search"
                                    placeholder="Ketik Nama Kos..." />
                            </div>

                            {{-- Sort --}}
                            <div class="mb-4">
                                <label for="sort" class="form-label fw-semibold">Urutkan Berdasarkan</label>
                                <select class="form-select" id="sort" wire:model.live="sort">
                                    <option value="">Pilih Satu</option>
                                    <option value="price_asc">Harga Termurah</option>
                                    <option value="price_desc">Harga Termahal</option>
                                    <option value="newest">Terbaru</option>
                                </select>
                            </div>
                            {{-- Tipe Kos --}}
                            <div class="mb-4">
                                <h6 class="fw-semibold">Tipe Kos</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model.live="category"
                                        value="male" id="typePutra">
                                    <label class="form-check-label" for="typePutra">Putra</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model.live="category"
                                        value="female" id="typePutri">
                                    <label class="form-check-label" for="typePutri">Putri</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model.live="category"
                                        value="mixed" id="typeCampur">
                                    <label class="form-check-label" for="typeCampur">Campur</label>
                                </div>
                            </div>

                            {{-- Fasilitas --}}
                            <div class="mb-4">
                                <h6 class="fw-semibold">Fasilitas</h6>
                                @foreach ($all_facilities as $facility)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model.live="facilities"
                                            value="{{ $facility }}" id="{{ $facility }}">
                                        <label class="form-check-label"
                                            for="{{ $facility }}">{{ $facility }}</label>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </aside>

                    <section class="col-lg-8 pt-5">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-bold mb-0">Hasil Pencarian</h3>
                            <p class="text-muted mb-0">Menampilkan {{ $this->boardingHouses->firstItem() }} -
                                {{ $this->boardingHouses->lastItem() }} dari {{ $this->boardingHouses->total() }} kos</p>
                        </div>

                        @foreach ($this->boardingHouses as $item)
                            <div class="card kos-card mb-4 shadow-sm">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ $item->thumbnail ? Storage::url($item->thumbnail) : "https://dummyimage.com/600x400/000/bfbfbf&text=no+image" }}"
                                            class="img object-fit-cover rounded-start" alt="Kamar Kos"
                                            style="width: 100%; height: 300px">
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
                                                class="btn btn-primary fw-bold stretched-link mt-3">
                                                Lihat
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{ $this->boardingHouses->links() }}

                    </section>
                </div>
        </div>
    @endvolt

</x-guest-layout>
