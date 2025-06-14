<?php

use App\Models\{Room, Transaction};
use function Livewire\Volt\{state, computed, on};
use function Laravel\Folio\{name};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Carbon\Carbon;
use App\Services\FonnteService;

name("catalog.show");

state([
    "selectedRoom" => null,
    "boardingHouse",

    "owner" => fn() => $this->boardingHouse->owner,

    "duration" => "",
    "check_in" => "",
    "rooms" => fn() => $this->boardingHouse->rooms->map(function ($room) {
        $isAvailable = $room->status === "available";

        return (object) array_merge($room->toArray(), [
            "isAvailable" => $isAvailable,
            "statusClass" => $isAvailable ? "success" : "danger",
            "statusIcon" => $isAvailable ? "check" : "x",
            "buttonClass" => $isAvailable ? "primary" : "secondary disabled",
        ]);
    }),
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
    if (!Auth::check()) {
        return Redirect::route("login");
    }

    $this->validate([
        "duration" => "required|in:1,3,6,12",
        "check_in" => "required|date",
    ]);

    if (!$this->selectedRoom) {
        $this->addError("selectedRoom", "Silakan pilih kamar terlebih dahulu.");
        return;
    }

    try {
        $user = Auth::user();

        // Buat kode transaksi yang lebih unik dan aman
        $transactionCode = "INV-" . now()->format("dmY-His") . "-" . strtoupper(Str::random(4));

        // Hitung check-out
        $checkOut = Carbon::parse($this->check_in)->addMonths($this->duration);

        // Simpan transaksi
        $transaction = Transaction::create([
            "user_id" => $user->id,
            "boarding_house_id" => $this->boardingHouse->id,
            "room_id" => $this->selectedRoom->id,
            "code" => $transactionCode,
            "check_in" => $this->check_in,
            "check_out" => $checkOut,
            "total" => $this->total,
        ]);

        if ($transaction) {
            $this->selectedRoom->update(["status" => "booked"]);

            $owner = $this->owner;

            // Kirim WhatsApp (bisa dipindah ke Job bila perlu)
            $message = "📢 *Notifikasi Transaksi Baru!*\n\n" . "📌 *Kode Transaksi:* {$transactionCode}\n" . "👤 *Penyewa:* {$user->name} (ID: {$user->id})\n" . "🏠 *Kamar:* {$this->selectedRoom->name} (ID: {$this->selectedRoom->id})\n" . "📅 *Check-in:* " . Carbon::parse($this->check_in)->translatedFormat("d F Y") . "\n" . "📅 *Check-out:* " . Carbon::parse($checkOut)->translatedFormat("d F Y") . "\n" . "💰 *Total Pembayaran:* " . formatRupiah($this->total) . "\n" . "📂 *Status:* " . __($transaction->status) . "\n\n" . "Silakan cek detail transaksi di sistem admin Anda.";

            (new FonnteService())->send("628978301766", $message);
        }

        LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

        return Redirect::route("transactions.index");
    } catch (\Throwable $th) {
        report($th); // log error ke Laravel log

        LivewireAlert::title("Proses gagal!")->position("center")->error()->toast()->show();

        return Redirect::route("catalog.show", [
            "BoardingHouse" => $this->BoardingHouse,
        ]);
    }
};

?>

<x-guest-layout>
    @include("components.partials.fancybox")

    @volt
        <div class="container my-5">

            <div class="row">
                <div class="col-lg-6">
                    <div class="kos-gallery">
                        <a data-fancybox
                            data-src="{{ $boardingHouse->thumbnail ? Storage::url($boardingHouse->thumbnail) : "https://dummyimage.com/600x400/000/bfbfbf&text=no+image" }}"
                            data-caption="thumbnail">
                            <img src="{{ $boardingHouse->thumbnail ? Storage::url($boardingHouse->thumbnail) : "https://dummyimage.com/600x400/000/bfbfbf&text=no+image" }}"
                                class="img object-fit-cover mb-3 border" alt="Foto Utama Kos" width="100%" height="500px">
                        </a>

                        <div class="row g-3">
                            @foreach ($boardingHouse->galleries as $gallery)
                                <div class="col-3">
                                    <a data-fancybox="gallery"
                                        data-src="{{ $gallery->image ? Storage::url($gallery->image) : "https://dummyimage.com/600x400/000/bfbfbf&text=no+image" }}"
                                        data-caption="Foto Galeri">
                                        <img src="{{ $gallery->image ? Storage::url($gallery->image) : "https://dummyimage.com/600x400/000/bfbfbf&text=no+image" }}"
                                            class="img-fluid border" style="object-fit: cover; width: 100%; height: 100px;"
                                            alt="Foto Galeri">
                                    </a>

                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-lg-6" id="formTransaction">
                    <div class="card shadow-0 border-0">
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

                            <div class="alert alert-secondary" role="alert">
                                <p>Silakan pilih tipe kamar yang tersedia untuk melanjutkan pemesanan.</p>

                                <form wire:submit="submitTransaction" class="row">
                                    @csrf

                                    <div class="col-12 mb-3">
                                        <input type="text" id="roomId" class="form-control" aria-describedby="helpId"
                                            placeholder="kamar yang dipilih"
                                            value="{{ $selectedRoom !== null ? "Kamar " . $selectedRoom->room_number : "" }}"
                                            readonly />

                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="check_in" class="form-label">Tanggal Mulai</label>
                                        <input type="date" wire:model="check_in" class="form-control form-control-sm"
                                            name="check_in" id="check_in" aria-describedby="check_in"
                                            min="{{ today()->format("Y-m-d") }}" placeholder="check_in" />

                                        @error("check_in")
                                            <p id="check_in" class="mt-1 small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="duration" class="form-label">Periode Sewa</label>
                                        <select wire:model.live="duration" class="form-select form-select-sm"
                                            name="duration" id="duration">
                                            <option selected>Pilih Durasi</option>
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

                @foreach ($rooms as $room)
                    {{-- @php
                        $isAvailable = $room->status === "available";
                        $statusClass = $isAvailable ? "success" : "danger";
                        $statusIcon = $isAvailable ? "check" : "x";
                        $buttonClass = $isAvailable ? "primary" : "secondary disabled";
                    @endphp --}}

                    <div class="card card-room mb-3 shadow-sm rounded">
                        <div class="row g-0">
                            <div class="col-md-2">
                                <img src="https://dummyimage.com/600x400/000/bfbfbf&text={{ $room->size }}"
                                    class="img-fluid object-fit-cover w-100 h-100" loading="lazy"
                                    alt="Kamar {{ $room->room_number }}">
                            </div>

                            <div class="col-md-10">
                                <div class="card-body d-flex flex-column h-100">

                                    {{-- Judul & Status --}}
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="card-title fw-bold mb-2">Kamar {{ $room->room_number }}</h5>
                                            <small class="fw-semibold text-muted">Ukuran: {{ $room->size }}
                                                m<sup>2</sup>
                                            </small>
                                        </div>

                                        <span class="badge bg-{{ $room->statusClass }}">
                                            <i class="bi bi-{{ $room->statusIcon }}-circle me-1"></i>
                                            {{ __("room_status." . $room->status) }}
                                        </span>
                                    </div>

                                    {{-- Harga & Tombol --}}
                                    <div class="mt-auto d-flex justify-content-between align-items-center pt-3">
                                        <p class="card-text fs-5 fw-bold text-primary mb-0">
                                            {{ formatRupiah($room->price) }}
                                            <small class="fw-normal">/bulan</small>
                                        </p>

                                        <a href="#formTransaction" wire:click='selectRoom({{ $room->id }})'
                                            class="btn btn-{{ $room->buttonClass }}">
                                            Sewa Sekarang
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>

            @include("pages.guest.catalog.review")

        </div>
    @endvolt
</x-guest-layout>
