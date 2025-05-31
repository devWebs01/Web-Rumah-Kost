<?php

use App\Models\User;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

name("guests.index");

state([
    "users" => fn() => User::latest()
        ->where("role", "guest")
        ->select(["id", "name", "email"])
        ->get(),
]);

$destroy = function (User $user) {
    $user->delete();

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("guests.index");
};

?>

<x-panel-layout>
    <x-slot name="title">Data guest</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="{{ route("guests.index") }}">
                Penyewa
            </a>
        </li>

    </x-slot>

    @include("components.partials.datatable")
    @volt
        <div>
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route("guests.create") }}" role="button">Tambah Data</a>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $no => $user)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <div class="d-flex gap-3 justify-content-center">
                                                <a type="button" class="btn btn-warning btn-sm"
                                                    href="{{ route("guests.edit", ["user" => $user]) }}">Edit</a>
                                                <button role="button" wire:click="destroy({{ $user }})"
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
    @endvolt
</x-panel-layout>
