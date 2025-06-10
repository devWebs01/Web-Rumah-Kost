<?php

use App\Models\{Room, Transaction};
use function Livewire\Volt\{state, computed, on};
use function Laravel\Folio\{name};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Carbon\Carbon;

name("catalog.show");

state([
    "selectedRoom" => null,
    "boardingHouse",

    //
    "duration" => "",
    "check_in" => "",
]);

$selectRoom = function ($roomId) {
    $this->selectedRoom = Room::find($roomId);
    $this->dispatch("updateTotalPrice");
};

$total = computed(function () {
    if (!$this->selectedRoom || !$this->duration) {
        return 0;
    }

    return $this->selectedRoom->price * $this->duration;
});

$submitTransaction = function () {
    // Cek apakah user login
    if (!Auth::check()) {
        return Redirect::route("login");
    }

    // Validasi input
    $this->validate([
        "duration" => "required|in:1,3,6,12",
        "check_in" => "required|date",
    ]);

    if (!$this->selectedRoom) {
        $this->addError("selectedRoom", "Silakan pilih kamar terlebih dahulu.");
        return;
    }

    // Simpan transaksi
    Transaction::create([
        "user_id" => Auth::id(),
        "room_id" => $this->selectedRoom->id,
        "code" => "INV-" . Carbon::today()->format("dmymsi"),
        "check_in" => $this->check_in,
        "check_out" => Carbon::parse($this->check_in)->addMonths($this->duration),
        "total" => $this->total,
    ]);

    // Tampilkan notifikasi
    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    // Redirect ke halaman transaksi
    return Redirect::route("transactions.index");
};

?>

<x-guest-layout>
    @include("components.partials.fancybox")

    <style>
        .kost-gallery img {
            border-radius: .5rem;
        }

        .section-title {
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .card-room .badge {
            font-size: 0.9em;
        }

        .review-stars .bi-star-fill {
            color: #ffc107;
            /* Warna kuning untuk bintang */
        }

        .review-stars .bi-star {
            color: #e0e0e0;
            /* Warna abu-abu untuk bintang kosong */
        }
    </style>

    @volt
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-7">
                    <div class="kost-gallery">
                        <img src="{{ Storage::url($boardingHouse->thumbnail) }}" class="img-fluid w-100 mb-3"
                            alt="Foto Utama Kos">
                        <div class="row g-3">
                            @foreach ($boardingHouse->galleries as $gallery)
                                <div class="col-3">
                                    <img src="{{ Storage::url($gallery->image) }}" class="img-fluid"
                                        style="object-fit: cover; width: 100%; height: 100px;" alt="Foto Kamar 1">
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <p>
                                <span class="badge bg-primary">{{ __("category." . $boardingHouse->category) }}</span>
                            </p>
                            <h1 class="h3 fw-bold">{{ $boardingHouse->name }}</h1>
                            <p class="text-muted">
                                {{ $boardingHouse->address }}
                            </p>

                            <a href="{{ $boardingHouse->location_map }}" target="_blank"
                                class="btn btn-outline-primary btn-sm mb-4">
                                <i class="bi bi-map-fill me-2">
                                </i>Lihat di Google Maps</a>

                            <div class="alert alert-info" role="alert">
                                <p>Silakan pilih tipe kamar yang tersedia untuk melanjutkan pemesanan.</p>

                                <form wire:submit="submitTransaction">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="check_in" class="form-label">Tanggal Mulai Sewa</label>
                                        <input type="date" wire:model="check_in" class="form-control form-control-sm"
                                            name="check_in" id="check_in" aria-describedby="check_in"
                                            min="{{ today()->format("Y-m-d") }}" placeholder="check_in" />

                                        @error("check_in")
                                            <p id="check_in" class="mt-1 small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Durasi Sewa</label>
                                        <select wire:model.live="duration" class="form-select form-select-sm"
                                            name="duration" id="duration">
                                            <option selected>Select one</option>
                                            <option value="1">Per 1 Bulan</option>
                                            <option value="3">Per 3 Bulan</option>
                                            <option value="6">Per 6 Bulan</option>
                                            <option value="12">Per 1 Tahun</option>
                                        </select>
                                        @error("duration")
                                            <p id="check_in" class="mt-1 small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <hr>

                                    <div class="table-responsive">
                                        <table class="table table-body">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        {{ formatRupiah($selectedRoom->price ?? "0") }}
                                                    </td>
                                                    <td class="text-center">X</td>
                                                    <td class="text-end">{{ $duration ?? "0" }} Bulan</td>
                                                </tr>
                                                <tr class="fw-bolder">
                                                    <td>Total</td>
                                                    <td colspan="2" class="text-end">
                                                        {{ formatRupiah($this->total ?? "0") }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <button type="submit"
                                            class="{{ !empty($selectedRoom) ?: "disabled" }} w-100 btn btn-primary">
                                            Submit
                                        </button>

                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section id="fasilitas" class="mt-5">
                <h2 class="section-title">Fasilitas Kos</h2>
                <p>
                    @foreach ($boardingHouse->facilities as $facility)
                        <span class="badge bg-secondary me-2 mb-2 p-2 fw-normal">
                            {{ $facility->name }}
                        </span>
                    @endforeach
                </p>
            </section>

            <section id="daftar-kamar" class="my-5">
                <h2 class="section-title">Pilihan Kamar</h2>
                @foreach ($boardingHouse->rooms as $room)
                    <div class="card card-room mb-3 shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-3">
                                <img src="https://dummyimage.com/600x400/000/bfbfbf&text=no+image"
                                    class="img-fluid rounded-start h-100 w-100 object-fit-cover"
                                    alt="{{ $room->room_number }}">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body d-flex flex-column h-100">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h5 class="card-title fw-bold">
                                            Kamar {{ $room->room_number }}
                                        </h5>
                                        <span class="badge bg-{{ $room->status === "available" ? "success" : "danger" }}">
                                            <i
                                                class="bi bi-{{ $room->status === "available" ? "check" : "x" }}-circle me-1">
                                            </i>
                                            {{ __("room_status." . $room->status) }}
                                        </span>
                                    </div>

                                    <div class="mt-auto d-flex justify-content-between align-items-center">
                                        <p class="card-text fs-5 fw-bold text-primary mb-0">
                                            {{ formatRupiah($room->price) }}
                                            <small class="fw-normal">/bulan</small>
                                        </p>
                                        <button wire:click='selectRoom({{ $room->id }})'
                                            class="btn btn-{{ $room->status === "available" ? "primary" : "secondary disabled" }}">
                                            Sewa Sekarang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </section>

            <section id="review" class="my-5">
                <h2 class="section-title">Review Pengguna</h2>
                <div class="card card-body border-0 shadow-sm">
                    <div class="d-flex align-items-center mb-3">
                        <h3 class="fw-bold mb-0 me-3">4.8</h3>
                        <div class="review-stars fs-4">
                            <i class="bi bi-star-fill">

                            </i>
                            <i class="bi bi-star-fill">

                            </i>
                            <i class="bi bi-star-fill">

                            </i>
                            <i class="bi bi-star-fill">

                            </i>
                            <i class="bi bi-star-half">

                            </i>
                        </div>
                        <span class="ms-3 text-muted">(dari 25 review)</span>
                    </div>
                    <hr>

                    <div class="review-list">
                        <div class="d-flex mb-3">
                            <img src="https://i.pravatar.cc/50?u=a" alt="User" class="rounded-circle me-3"
                                style="width: 50px; height: 50px;">
                            <div>
                                <h6 class="fw-bold mb-0">Budi Santoso</h6>
                                <div class="review-stars small">
                                    <i class="bi bi-star-fill">
                                    </i>
                                    <i class="bi bi-star-fill">
                                    </i>
                                    <i class="bi bi-star-fill">
                                    </i>
                                    <i class="bi bi-star-fill">
                                    </i>
                                    <i class="bi bi-star-fill">
                                    </i>
                                </div>
                                <p class="mt-1">Tempatnya bersih, nyaman, dan fasilitasnya lengkap. Bapak kos ramah.
                                    Recommended!</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <img src="https://i.pravatar.cc/50?u=b" alt="User" class="rounded-circle me-3"
                                style="width: 50px; height: 50px;">
                            <div>
                                <h6 class="fw-bold mb-0">Citra Lestari</h6>
                                <div class="review-stars small">
                                    <i class="bi bi-star-fill">
                                    </i>
                                    <i class="bi bi-star-fill">
                                    </i>
                                    <i class="bi bi-star-fill">
                                    </i>
                                    <i class="bi bi-star-fill">
                                    </i>
                                    <i class="bi bi-star">
                                    </i>
                                </div>
                                <p class="mt-1">Cukup baik, hanya saja sinyal WiFi kadang kurang stabil di kamar saya.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="add-review mt-4">
                        <h5 class="fw-bold">Tulis Review Anda</h5>
                        <form>
                            <div class="mb-3">
                                <label for="namaReviewer" class="form-label">Nama Anda</label>
                                <input type="text" class="form-control" id="namaReviewer"
                                    placeholder="Masukkan nama Anda">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Pilih rating bintang</option>
                                    <option value="5">★★★★★ (Luar Biasa)</option>
                                    <option value="4">★★★★☆ (Baik)</option>
                                    <option value="3">★★★☆☆ (Cukup)</option>
                                    <option value="2">★★☆☆☆ (Kurang)</option>
                                    <option value="1">★☆☆☆☆ (Buruk)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="komentar" class="form-label">Komentar Anda</label>
                                <textarea class="form-control" id="komentar" rows="3"
                                    placeholder="Bagikan pengalaman Anda menginap di sini...">
                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Kirim Review</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    @endvolt
</x-guest-layout>
