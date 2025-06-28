<?php

use function Livewire\Volt\{state};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use function Laravel\Folio\{name};
use Carbon\Carbon;

name("owner.transactions.show");

state(["transaction"]);

$confirmed = function (): void {
    $this->transaction->update([
        "status" => "confirmed",
    ]);
};

$cancelled = function (): void {
    $this->transaction->update([
        "status" => "cancelled",
    ]);
};

?>

<x-panel-layout>
    <x-slot name="title">Detail Transaksi</x-slot>

    <x-slot name="header">
        <li class="breadcrumb-item"><a href="{{ route("transactions.index") }}">Data Transaksi</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </x-slot>

    @include("components.partials.fancybox")

    @volt
        <div>
            {{-- Warning message example, adapt as needed --}}
            @if ($transaction->status === "pending")
                <div class="alert alert-warning d-flex align-items-center py-2" role="alert">
                    <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"></i>
                    <div>
                        Transaksi ini menunggu konfirmasi Anda. Mohon segera tinjau.
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-8">
                    {{-- Transaction Details Section --}}
                    <div class="card bg-light border-0 mb-4 shadow-sm">

                        {{-- Action Buttons (Re-locate if needed based on the image, but putting them at the end makes sense) --}}
                        <div class="card-header mb-5">
                            @if ($transaction->status === "pending")
                                <div class=" gap-2">
                                    <button type="button" wire:click='confirmed' class="btn btn-success px-4 me-2">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        Konfirmasi Transaksi
                                    </button>

                                    <button type="button" wire:click='cancelled' class="btn btn-outline-danger px-4">
                                        <i class="bi bi-check-circle me-2"></i>
                                        Tolak Transaksi
                                    </button>

                                </div>
                            @else
                                <div
                                    class="alert {{ $transaction->status === "confirmed" ? "alert-success" : "alert-danger" }} shadow-sm py-3 mb-0">
                                    <h5 class="alert-heading mb-2">Status Transaksi:
                                        {{ __("transaction_status." . $transaction->status) }}</h5>
                                    @if ($transaction->status === "confirmed")
                                        <p class="mb-0">Transaksi ini telah berhasil dikonfirmasi. Penyewa dapat
                                            segera melakukan check-in.</p>
                                    @elseif ($transaction->status === "cancelled")
                                        <p class="mb-0">Transaksi ini telah ditolak. Silakan hubungi penyewa jika
                                            diperlukan.</p>
                                    @elseif ($transaction->status === "completed")
                                        <p class="mb-0">Transaksi ini telah selesai.</p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="card-body p-4">
                            <h5 class="card-title mb-3 fw-bold">Transaction Details</h5>
                            <div class="row g-3">

                                {{-- Transaction Number --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">INVOICE</p>
                                    <p class="mb-0 fw-semibold">{{ $transaction->code }}</p>
                                </div>

                                {{-- Amount --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">TOTAL</p>
                                    <p class="mb-0 fw-semibold text-success">{{ formatRupiah($transaction->total) }}</p>
                                </div>

                                {{-- Category --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">TRANSAKSI</p>
                                    <p class="mb-0 fw-semibold">Sewa Kos</p>
                                </div>

                                {{-- Room & Boarding House --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">kAMAR</p>
                                    <p class="mb-0 fw-semibold">Kamar {{ $transaction->room->room_number }}</p>
                                </div>

                                {{-- Check-in --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">Check-In</p>
                                    <p class="mb-0 fw-semibold">
                                        {{ Carbon::parse($transaction->check_in)->translatedFormat("d M Y") }}
                                    </p>
                                </div>

                                {{-- Check-out --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">Check-Out</p>
                                    <p class="mb-0 fw-semibold">
                                        {{ Carbon::parse($transaction->check_out)->translatedFormat("d M Y") }}
                                    </p>
                                </div>

                                {{-- Created At --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">TANGGAL TRANSAKSI</p>
                                    <p class="mb-0 fw-semibold">
                                        {{ Carbon::parse($transaction->created_at)->translatedFormat("d M Y, H:i") }}
                                    </p>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">Status</p>
                                    <p class="mb-0 fw-semibold">
                                        <span
                                            class="badge
{{ $transaction->status === "pending"
    ? "bg-warning text-dark"
    : ($transaction->status === "confirmed"
        ? "bg-success"
        : "bg-danger") }}">
                                            {{ __("transaction_status." . $transaction->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Kos Details Section --}}
                    <div class="card bg-light border-0 mb-4 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3 fw-bold">Rincian Kos</h5>
                            <div class="row g-3">

                                {{-- Nama Kos --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">Nama Kos</p>
                                    <p class="mb-0 fw-semibold">{{ $transaction->boardingHouse->name ?? "N/A" }}</p>
                                </div>

                                {{-- Alamat --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">Alamat</p>
                                    <p class="mb-0 fw-semibold">{{ $transaction->boardingHouse->address ?? "N/A" }}</p>
                                </div>

                                {{-- Peta Lokasi --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">Peta Lokasi</p>
                                    @if ($transaction->boardingHouse->location_map)
                                        <a href="{{ $transaction->boardingHouse->location_map }}" target="_blank"
                                            class="text-decoration-underline">
                                            Lihat di Maps
                                        </a>
                                    @else
                                        <p class="mb-0 text-muted fst-italic">Tidak tersedia</p>
                                    @endif
                                </div>

                                {{-- Kategori Kos --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">Kategori</p>
                                    <p class="mb-0 fw-semibold">
                                        {{ __("category." . $transaction->boardingHouse->category) }}
                                    </p>
                                </div>

                                {{-- Status Verifikasi --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">Status Verifikasi</p>
                                    <p class="mb-0 fw-semibold">
                                        <span
                                            class="badge {{ $transaction->boardingHouse->verification_status === "verified" ? "bg-success" : "bg-secondary" }}">
                                            {{ __("verification_status." . $transaction->boardingHouse->verification_status) }}
                                        </span>
                                    </p>
                                </div>

                                {{-- Pemilik Kos --}}
                                <div class="col-md-4 col-sm-6">
                                    <p class="text-muted text-uppercase mb-1 small fw-medium">Pemilik</p>
                                    <p class="mb-0 fw-semibold">{{ $transaction->boardingHouse->owner->name ?? "N/A" }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Flip Card: User Profile -->
                    <div id="identity" class="flip-card"
                        onclick="document.getElementById('identity').classList.toggle('flipped')">
                        <div class="flip-card-inner">
                            <!-- FRONT SIDE: Data Diri -->
                            <div class="flip-card-front p-4">
                                <h4 class="card-title text-center mb-3">Profil Penyewa</h4>
                                <div class="text-center mb-3">
                                    <img src="{{ "https://api.dicebear.com/9.x/adventurer/svg?seed=" . ($name ?? "Mason") }}"
                                        alt="Avatar" class="img-fluid rounded-circle border" width="100"
                                        height="100">
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-end fw-bold">Nama:</div>
                                    <div class="col-8 mb-1">
                                        <div style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $transaction->user->name ?? "-" }}
                                        </div>
                                    </div>

                                    <div class="col-4 text-end fw-bold">Email:</div>
                                    <div class="col-8 mb-1">
                                        <div style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $transaction->user->email ?? "-" }}
                                        </div>
                                    </div>

                                    <div class="col-4 text-end fw-bold">Telp:</div>
                                    <div class="col-8 mb-1">
                                        <div
                                            style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $transaction->user->identity->phone_number ?? "-" }}
                                        </div>
                                    </div>

                                    <div class="col-4 text-end fw-bold">WA:</div>
                                    <div class="col-8 mb-1">
                                        <div
                                            style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $transaction->user->identity->whatsapp_number ?? "-" }}
                                        </div>
                                    </div>

                                    <div class="col-4 text-end fw-bold">Alamat:</div>
                                    <div class="col-8 mb-1">
                                        <div
                                            style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $transaction->user->identity->address ?? "-" }}
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- BACK SIDE: ID Card -->
                            <div class="flip-card-back d-flex justify-content-center align-items-center">
                                @if ($transaction->user->identity->id_card)
                                    <a href="{{ Storage::url($transaction->user->identity->id_card) }}" data-fancybox
                                        data-caption="ID Card">
                                        <img src="{{ Storage::url($transaction->user->identity->id_card) }}"
                                            class="img-fluid rounded shadow" alt="ID Card"
                                            style="max-height: 200px; object-fit: contain;" />
                                    </a>
                                @else
                                    <p class="text-white text-center">ID Card belum tersedia</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    @endvolt
</x-panel-layout>
