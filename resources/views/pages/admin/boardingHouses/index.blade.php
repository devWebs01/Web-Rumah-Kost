<?php

use App\Models\BoardingHouse;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};

name("boardingHouses.index");

state([
    "boardingHouses" => fn() => BoardingHouse::latest()->get(),
]);

$verified = function (BoardingHouse $boardingHouse) {
    $boardingHouse->update([
        "status" => "verified",
    ]);
};

$rejected = function (BoardingHouse $boardingHouse) {
    $boardingHouse->update([
        "status" => "rejected",
    ]);
};

?>

<x-panel-layout>
    <x-slot name="title">Data Kos</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="{{ route("boardingHouses.index") }}">
                Kos
            </a>
        </li>

    </x-slot>

    @include("components.partials.datatable")
    @volt
        <div>
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route("admins.create") }}" role="button">Tambah Data</a>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Thumbnail</th>
                                    <th>Nama Kos</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($boardingHouses as $no => $boardingHouse)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>
                                            <img src="{{ Storage::url($boardingHouse->thumbnail) }}"
                                                class="img-fluid rounded object-fit-cover" width="80px" height="80px"
                                                alt="thumbnail" />
                                        </td>
                                        <td>{{ $boardingHouse->name }}</td>
                                        <td>
                                            {{ __("category." . $boardingHouse->category) }}
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">
                                                {{ __("verification_status." . $boardingHouse->verification_status) }}
                                            </span>

                                        </td>
                                        <td>
                                            <div class="d-flex gap-3 justify-content-center">
                                                <a type="button" class="btn btn-primary btn-sm"
                                                    href="{{ route("boardingHouses.show", ["boardingHouse" => $boardingHouse->id]) }}">Lihat</a>

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
    @endvolt
</x-panel-layout>
