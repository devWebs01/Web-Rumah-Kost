<?php

use function Livewire\Volt\{state};
use function Laravel\Folio\{name};

name("guests.edit");

state([
    "name" => fn() => $this->user->name,
    "email" => fn() => $this->user->email,
    "phone_number" => fn() => $this->user->identity->phone_number ?? null,
    "whatsapp_number" => fn() => $this->user->identity->whatsapp_number ?? null,
    "address" => fn() => $this->user->identity->address ?? null,
    "id_card",
    "password",
    "user",
    "logs" => fn() => \Spatie\Activitylog\Models\Activity::where("causer_id", $this->user->id)->latest()->take(10)->get(),
]);

?>

<x-panel-layout>
    <x-slot name="title">Edit Data</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="{{ route("guests.index") }}">
                Penyewa
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">
                Lihat Data
            </a>
        </li>

    </x-slot>

    @include("components.partials.fancybox")
    @volt
        <div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" wire:model.blur="name" name="name"
                                            id="name" aria-describedby="helpId" placeholder="enter name" readonly />

                                        @error("name")
                                            <small id="helpId" class="form-text text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label">Email</label>
                                        <input type="email" class="form-control" wire:model.blur="email" name="email"
                                            id="email" aria-describedby="helpId" placeholder="enter email" readonly />

                                        @error("email")
                                            <small id="helpId" class="form-text text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="phone_number" class="form-label">
                                            No. Telephone
                                        </label>
                                        <input type="number" class="form-control" wire:model.blur="phone_number"
                                            name="phone_number" id="phone_number" aria-describedby="helpId"
                                            placeholder="enter phone_number" readonly />

                                        @error("phone_number")
                                            <small id="helpId" class="form-text text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="whatsapp_number" class="form-label">No. Whatsapp</label>
                                        <input type="number" class="form-control" wire:model.blur="whatsapp_number"
                                            name="whatsapp_number" id="whatsapp_number" aria-describedby="helpId"
                                            placeholder="enter whatsapp_number" readonly />

                                        @error("whatsapp_number")
                                            <small id="helpId" class="form-text text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="address" class="form-label">Alamat</label>
                                        <textarea wire:model.blur="address" class="form-control" name="address" id="address" rows="4">{{ $address }}</textarea>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title mb-3">Aktivitas Pengguna</h5>

                            @if ($logs->count())
                                <ul class="list-group list-group-flush">
                                    @foreach ($logs as $log)
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <strong>{{ $log->description }}</strong><br>
                                                    <small class="text-muted">
                                                        {{ \Carbon\Carbon::parse($log->created_at)->translatedFormat("d M Y H:i") }}
                                                    </small>
                                                </div>
                                                @if ($log->subject_type)
                                                    <small class="text-muted text-end">
                                                        <em>{{ class_basename($log->subject_type) }}</em>
                                                    </small>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">Belum ada aktivitas tercatat.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div id="identity" class="flip-card"
                        onclick="document.getElementById('identity').classList.toggle('flipped')">
                        <div class="flip-card-inner">
                            <!-- FRONT SIDE: Data Diri -->
                            <div class="flip-card-front p-4">
                                <h4 class="card-title text-center mb-3">Profil Pengguna</h4>
                                <div class="text-center mb-3">
                                    <img src="{{ "https://api.dicebear.com/9.x/adventurer/svg?seed=" . ($name ?? "Mason") }}"
                                        alt="Avatar" class="img-fluid rounded-circle border" width="100"
                                        height="100">
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-end fw-bold">Nama:</div>
                                    <div class="col-8 mb-1">
                                        <div style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $name ?? "-" }}
                                        </div>
                                    </div>

                                    <div class="col-4 text-end fw-bold">Email:</div>
                                    <div class="col-8 mb-1">
                                        <div style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $email ?? "-" }}
                                        </div>
                                    </div>

                                    <div class="col-4 text-end fw-bold">Telp:</div>
                                    <div class="col-8 mb-1">
                                        <div
                                            style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $phone_number ?? "-" }}
                                        </div>
                                    </div>

                                    <div class="col-4 text-end fw-bold">WA:</div>
                                    <div class="col-8 mb-1">
                                        <div
                                            style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $whatsapp_number ?? "-" }}
                                        </div>
                                    </div>

                                    <div class="col-4 text-end fw-bold">Alamat:</div>
                                    <div class="col-8 mb-1">
                                        <div
                                            style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $address ?? "-" }}
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- BACK SIDE: ID Card -->
                            <div class="flip-card-back d-flex justify-content-center align-items-center">
                                @if ($id_card)
                                    <a href="{{ $id_card->temporaryUrl() }}" data-fancybox data-caption="ID Card">
                                        <img src="{{ $id_card->temporaryUrl() }}" class="img-fluid rounded shadow"
                                            alt="ID Card" style="max-height: 200px; object-fit: contain;" />
                                    </a>
                                @elseif(!empty($user->identity->id_card))
                                    <a href="{{ Storage::url($user->identity->id_card) }}" data-fancybox
                                        data-caption="ID Card">
                                        <img src="{{ Storage::url($user->identity->id_card) }}"
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
