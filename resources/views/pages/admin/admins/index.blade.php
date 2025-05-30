<?php

use App\Models\User;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

name("admins.index");

state([
    "users" => fn() => User::latest()
        ->where("role", "admin")
        ->select(["id", "name", "email"])
        ->get(),
]);

$destroy = function (User $user) {
    $user->delete();

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("admins.index");
};

?>

<x-admin-layout>
    <x-slot name="title">Data Admin</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="{{ route("admins.index") }}">
                Admin
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
                                                    href="{{ route("admins.edit", ["user" => $user->id]) }}">Edit</a>
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
</x-admin-layout>
