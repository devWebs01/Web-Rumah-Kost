<?php

use function Livewire\Volt\{state};
use function Laravel\Folio\{name};

name("boardingHouse.index");

state([
    "step" => 1,
])->url();

state([
    "user" => Auth::user(),
    "boardingHouse" => fn() => $this->user->boardingHouse ?? null,
]);

?>

<x-panel-layout>
    <x-slot name="title">Data Kos</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="{{ route("boardingHouse.index") }}">Data Kos</a>
        </li>
    </x-slot>

    @include("components.partials.tom-select")

    @volt
        <div>

            @if ($boardingHouse->verification_status === "rejected")
                <div class="alert alert-danger d-flex align-items-center gap-3 p-3 rounded-2">
                    <i class="ti ti-x-circle fs-4 text-danger"></i>
                    <div>
                        <strong>Pengajuan Ditolak</strong><br>
                        Maaf, pengajuan data kos <strong>{{ $boardingHouse->name }}</strong> telah ditolak oleh admin.
                        Silakan periksa kembali data yang diisi atau hubungi pihak admin untuk informasi lebih lanjut.
                    </div>
                </div>
            @elseif ($boardingHouse->verification_status === "pending")
                <div class="alert alert-warning d-flex align-items-center gap-3 p-3 rounded-2">
                    <i class="ti ti-alert-triangle fs-4 text-warning"></i>
                    <div>
                        <strong>Menunggu Verifikasi</strong><br>
                        Data kos <strong>{{ $boardingHouse->name }}</strong> saat ini sedang dalam proses verifikasi oleh
                        admin.
                        Harap bersabar, Anda akan diberi notifikasi saat proses selesai.
                    </div>
                </div>
            @endif

            {{-- Notifikasi jika belum ada data kos --}}
            @if (!empty($boardingHouse))
                <div class="card w-100 bg-primary-subtle overflow-hidden border mb-4">
                    <div class="card-body bg-white position-relative">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="d-flex align-items-center mb-3">
                                    <h5 class="fw-semibold text-primary mb-0 fs-5">
                                        {{ __("category." . $boardingHouse->category) }}
                                    </h5>
                                </div>
                                <div class="mb-2">
                                    <h4 class="mb-0 fw-bolder">{{ $boardingHouse->name }}</h4>
                                </div>
                                <div class="mb-2">
                                    <p class="mb-0">
                                        {{ $boardingHouse->address }}
                                    </p>
                                </div>
                                <div class="mb-2">
                                    <p class="mb-0">
                                        <span class="badge bg-primary">
                                            {{ __("verification_status." . $boardingHouse->verification_status) }}
                                        </span>
                                    </p>
                                </div>
                                <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
                            </div>
                            <div class="col-sm-5 text-end">
                                <img src="{{ Storage::url($boardingHouse->thumbnail) }}" alt="Welcome"
                                    class="img-fluid rounded" width="250px">
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg class="bi me-2" width="24" height="24" fill="currentColor">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <strong>Perhatian!</strong><br> Data kos Anda belum dibuat. Silakan buat terlebih dahulu untuk
                        mulai mengelola properti Anda.
                    </div>
                </div>

                @include("pages.owner.boarding-house.create.index")
            @endif

            @include("pages.owner.rooms.index")

        </div>
    @endvolt
</x-panel-layout>
