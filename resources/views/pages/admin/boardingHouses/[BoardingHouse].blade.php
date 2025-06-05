<?php

use App\Models\BoardingHouse;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};

name("boardingHouses.show");

state(["boardingHouse"]);

?>

<x-panel-layout>
    <x-slot name="title">Data Kos</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="#">
                Kos
            </a>
        </li>

    </x-slot>

    @volt
        <div>
            <div class="card overflow-hidden">
                <div class="card-body p-0">
                    <img src="{{ Storage::url($boardingHouse->thumbnail) }}" alt="boarding-house-bg"
                        class="img object-fit-cover" width="100%" height="350px">
                    <div class="row align-items-center">
                        <div class="col-lg-4 order-lg-1 order-2">
                            <div class="d-flex align-items-center justify-content-around m-4">
                                <div class="text-center">
                                    <i class="ti ti-home fs-6 d-block mb-2"></i>
                                    <h4 class="mb-0 lh-1">{{ $boardingHouse->rooms->count() }}</h4>
                                    <p class="mb-0">Kamar</p>
                                </div>
                                <div class="text-center">
                                    <i class="ti ti-file-description fs-6 d-block mb-2"></i>
                                    <h4 class="mb-0 lh-1">{{ $boardingHouse->transaction ?? "0" }}</h4>
                                    <p class="mb-0">Transaksi</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                            <div class="mt-n5">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <div class="d-flex align-items-center justify-content-center round-110">
                                        <div
                                            class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden round-100">
                                            <img src="https://api.dicebear.com/9.x/adventurer/svg?seed=Chase"
                                                alt="owner-img" class="img-fluid object-fit-cover" width="90px"
                                                height="90px">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h5 class="mb-0 text-capitalize">{{ $boardingHouse->owner->name }}</h5>
                                    <p class="mb-0">Owner</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 order-last">
                            <ul
                                class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-end my-3 mx-4 pe-xxl-4 gap-3">
                                <li>
                                    <button class="btn btn-primary text-nowrap">
                                        {{ __("verification_status." . $boardingHouse->verification_status) }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-primary-subtle rounded-2 rounded-top-0"
                        id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active hstack gap-2 rounded-0 py-6" id="pills-profile-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab"
                                aria-controls="pills-profile" aria-selected="true">
                                <i class="ti ti-home fs-5"></i>
                                <span class="d-none d-md-block">Details</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link hstack gap-2 rounded-0 py-6" id="pills-rooms-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-rooms" type="button" role="tab" aria-controls="pills-rooms"
                                aria-selected="false" tabindex="-1">
                                <i class="ti ti-home fs-5"></i>
                                <span class="d-none d-md-block">
                                    Kamar
                                </span>
                            </button>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                    aria-labelledby="pills-profile-tab" tabindex="0">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card shadow-none border">
                                <div class="card-body">
                                    <h4 class="mb-3">Informasi Detail Kos</h4>
                                    <p class="card-subtitle">
                                        Berikut ini adalah detail data kos
                                        <span class="text-primary">{{ $boardingHouse->name }}!</span>
                                    </p>

                                    <div class="vstack gap-3 mt-4">
                                        {{-- Nama Kos --}}
                                        <div class="hstack gap-6">
                                            <i class="ti ti-home text-dark fs-6"></i>
                                            <h6 class="mb-0">Nama Kos: {{ $boardingHouse->name }}</h6>
                                        </div>

                                        {{-- Alamat --}}
                                        <div class="hstack gap-6">
                                            <i class="ti ti-map-pin text-dark fs-6"></i>
                                            <h6 class="mb-0">Alamat: {{ $boardingHouse->address }} </h6>
                                        </div>

                                        {{-- Peta Lokasi (link atau tampilan embed, jika URL) --}}
                                        @if ($boardingHouse->location_map)
                                            <div class="hstack gap-6">
                                                <i class="ti ti-location text-dark fs-6"></i>
                                                <h6 class="mb-0">
                                                    Peta Lokasi:
                                                    <a href="{{ $boardingHouse->location_map }}" target="_blank"
                                                        class="text-primary">
                                                        Lihat di Peta
                                                    </a>
                                                </h6>
                                            </div>
                                        @endif

                                        {{-- Kategori Kos --}}
                                        <div class="hstack gap-6">
                                            <i class="ti ti-category text-dark fs-6"></i>
                                            <h6 class="mb-0">Kategori: {{ $boardingHouse->category }}</h6>
                                        </div>

                                        {{-- Pemilik Kos --}}
                                        <div class="hstack gap-6">
                                            <i class="ti ti-user text-dark fs-6"></i>
                                            <h6 class="mb-0">Pemilik: {{ $boardingHouse->owner->name }}</h6>
                                        </div>

                                        {{-- Email Pemilik (opsional) --}}
                                        @if ($boardingHouse->owner->email)
                                            <div class="hstack gap-6">
                                                <i class="ti ti-mail text-dark fs-6"></i>
                                                <h6 class="mb-0">Email Pemilik: {{ $boardingHouse->owner->email }}</h6>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="card shadow-none border">
                                <div class="card-body">
                                    <h4 class="fw-semibold mb-3">Gallery</h4>
                                    <div class="row">
                                        @foreach ($boardingHouse->galleries as $gallery)
                                            <div class="col-4">
                                                <img src="{{ Storage::url($boardingHouse->image) }}" alt="gallery-img"
                                                    class="rounded-1 img-fluid mb-9">
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card shadow-none border">
                                <div class="card-body">
                                    <h4 class="mb-3">Share Your Thoughts</h4>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control h-140" placeholder="Leave a comment here" id="floatingTextarea2"></textarea>
                                        <label for="floatingTextarea2">Your Comment</label>
                                    </div>
                                    <button class="btn btn-primary">Post</button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body border-bottom">
                                    <div class="d-flex align-items-center gap-6 flex-wrap">
                                        <img src="../assets/images/profile/user-1.jpg" alt="user-img"
                                            class="rounded-circle" width="40" height="40">
                                        <h6 class="mb-0">User Name</h6>
                                        <span class="fs-2 hstack gap-2">
                                            <span class="round-10 text-bg-light rounded-circle d-inline-block"></span>
                                            15 min ago
                                        </span>
                                    </div>
                                    <p class="text-dark my-3">This is a comment about the boarding house.</p>
                                    <div class="d-flex align-items-center my-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <a class="round-32 rounded-circle btn btn-primary p-0 hstack justify-content-center"
                                                href="javascript:void(0)" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Like">
                                                <i class="ti ti-thumb-up"></i>
                                            </a>
                                            <span class="text-dark fw-semibold">67</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 ms-4">
                                            <a class="round-32 rounded-circle btn btn-secondary p-0 hstack justify-content-center"
                                                href="javascript:void(0)" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Comment">
                                                <i class="ti ti-message-2"></i>
                                            </a>
                                            <span class="text-dark fw-semibold">2</span>
                                        </div>
                                        <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                            href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Share">
                                            <i class="ti ti-share"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-rooms" role="tabpanel" aria-labelledby="pills-rooms-tab"
                    tabindex="0">
                    <div class="row">
                        @foreach ($boardingHouse->rooms as $room)
                            <div class=" col-md-6 col-xl-4">
                                <div class="card">
                                    <div class="card-body p-4 d-flex align-items-center gap-6 flex-wrap">
                                        <img src="https://dummyimage.com/600x400/000/bfbfbf&text={{ $room->size }}
"
                                            alt="modernize-img" class="rounded-circle " width="40" height="40">
                                        <div>
                                            <h5 class="fw-semibold mb-0">
                                                Kamar {{ $room->room_number }}
                                            </h5>
                                            <span class="fs-2 d-flex align-items-center">
                                                {{ formatRupiah($room->price) }}
                                            </span>
                                        </div>
                                        <button class="btn btn-outline-primary py-1 px-2 ms-auto">
                                            {{ $room->status }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    @endvolt
</x-panel-layout>
