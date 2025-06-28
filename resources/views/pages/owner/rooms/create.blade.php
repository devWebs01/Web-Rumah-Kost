<?php

use function Livewire\Volt\{state};
use App\Models\{Room};
use function Laravel\Folio\{name};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

name("rooms.create");

state([
    "user" => Auth::user(),
    "room_number",
    "price",
    "size",
    "status",
]);

$create = function (): void {
    $validatedRoom = $this->validate([
        "room_number" => "required|string",
        "price" => "required|numeric|min:0",
        "size" => "required|string|max:10",
        "status" => "required|in:available,unavailable",
    ]);

    $validatedRoom["boarding_house_id"] = $this->user->boardingHouse->id;

    Room::create($validatedRoom);

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("boardingHouse.index");
};

?>

<x-panel-layout>
    <x-slot name="title">Tambah Kamar</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="{{ route("boardingHouse.index") }}">Data Kos</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route("rooms.create") }}">Tambah Kamar</a>
        </li>
    </x-slot>

    @volt
        <div>

            <div class="card">
                <div class="card-body">
                    <form wire:submit="create" class="row">
                        <!-- Pilih Kos -->

                        <!-- Nomor Kamar -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Kamar</label>
                            <input wire:model="room_number" type="text" class="form-control">
                            @error("room_number")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input wire:model="price" type="number" class="form-control" min="0">
                            @error("price")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Ukuran -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ukuran (cth: 3x4)</label>
                            <input wire:model="size" type="text" class="form-control">
                            @error("size")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select wire:model="status" class="form-select">
                                <option value="available">Tersedia</option>
                                <option value="unavailable">Tidak Tersedia</option>
                            </select>
                            @error("status")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Tombol -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    @endvolt
</x-panel-layout>
