<?php

use function Livewire\Volt\{state, on};
use function Laravel\Folio\{name};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

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
    <x-slot name="title">Profile Kost</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="{{ route("boardingHouse.index") }}">Profile Kost</a>
        </li>
    </x-slot>

    @include("components.partials.tom-select")

    @volt
        <div>

            {{-- Notifikasi jika belum ada data kost --}}
            @if (!empty($boardingHouse))
                <div class="card w-100 bg-primary-subtle overflow-hidden shadow-none">
                    <div class="card-body bg-white position-relative">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="d-flex align-items-center mb-7">
                                    <div class="rounded-circle overflow-hidden me-6">
                                        <img src="/be-assets/images/profile/user-1.jpg" alt="User" width="40"
                                            height="40">
                                    </div>
                                    <h5 class="fw-semibold mb-0 fs-5">Welcome back Mathew Anderson!</h5>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="border-end pe-4">
                                        <h3 class="mb-1 fw-semibold fs-8">$2,340 <i
                                                class="ti ti-arrow-up-right fs-5 text-success"></i></h3>
                                        <p class="mb-0 text-dark">Today’s Sales</p>
                                    </div>
                                    <div class="ps-4">
                                        <h3 class="mb-1 fw-semibold fs-8">35% <i
                                                class="ti ti-arrow-up-right fs-5 text-success"></i></h3>
                                        <p class="mb-0 text-dark">Overall Performance</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5 text-end">
                                <img src="https://bootstrapdemos.adminmart.com/modernize/dist/assets/images/backgrounds/welcome-bg.svg"
                                    alt="Welcome" class="img-fluid">
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
                        <strong>Perhatian!</strong><br> Data kost Anda belum dibuat. Silakan buat terlebih dahulu untuk
                        mulai mengelola properti Anda.
                    </div>
                </div>

                @include("pages.owner.boarding-house.create.index")
            @endif

        </div>
    @endvolt
</x-panel-layout>
