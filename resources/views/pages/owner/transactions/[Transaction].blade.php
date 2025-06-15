<?php

use function Livewire\Volt\{state};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use function Laravel\Folio\{name};
use Carbon\Carbon;

name("owner.transactions.show");

state(["transaction"]);

$confirmed = function () {
    $this->transaction->update([
        "status" => "confirmed",
    ]);
};

$cancelled = function () {
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
    @endvolt
</x-panel-layout>
