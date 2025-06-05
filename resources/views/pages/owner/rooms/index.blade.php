<?php

use function Livewire\Volt\{state, on};
use function Laravel\Folio\{name};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

name("rooms.index");

state([
    "step" => 1,
])->url();

state([
    "user" => Auth::user(),
    "rooms" => fn() => $this->user->boardingHouse->rooms ?? null,
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

            @if ($rooms)
                <div>
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-primary" href="{{ route("admins.create") }}" role="button">Tambah Data</a>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nomor Kamar</th>
                                            <th>Harga</th>
                                            <th>Ukuran</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rooms as $no => $room)
                                            <tr>
                                                <td>{{ ++$no }}</td>
                                                <td>{{ $room->room_number }}</td>
                                                <td>{{ $room->price }}</td>
                                                <td>{{ $room->size }}</td>
                                                <td>
                                                    <div class="d-flex gap-3 justify-content-center">
                                                        {{-- <a type="button" class="btn btn-warning btn-sm"
                                                            href="{{ route("admins.edit", ["room" => $room->id]) }}">Edit</a> --}}
                                                        <button role="button" wire:click="destroy({{ $room }})"
                                                            class="btn btn-danger btn-sm">Hapus</button>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            @else
                tidak aada
            @endif

        </div>
    @endvolt
</x-panel-layout>
