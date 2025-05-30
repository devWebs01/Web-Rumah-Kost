<?php

use App\Models\User;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

name("guests.create");

state(["name", "email", "password"]);

$create = function () {
    $validateData = $this->validate([
        "name" => "required|min:5",
        "email" => "required|min:5|unique:users",
        "password" => "min:5|required",
    ]);

    $validateData["password"] = bcrypt($this->password);
    $validateData["role"] = "guest";

    User::create($validateData);

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("guests.index");
};

?>

<x-admin-layout>
    <x-slot name="title">Edit Data</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="{{ route("guests.index") }}">
                Penyewa
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">
                Tambah Data
            </a>
        </li>

    </x-slot>

    @include("components.partials.datatable")
    @volt
        <div>
            <div class="card">
                <div class="card-body">
                    <form wire:submit="create">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" wire:model="name" name="name"
                                        id="name" aria-describedby="helpId" placeholder="enter name" />

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
                                    <input type="email" class="form-control" wire:model="email" name="email"
                                        id="email" aria-describedby="helpId" placeholder="enter email" />

                                    @error("email")
                                        <small id="helpId" class="form-text text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Kata Sandi</label>
                                    <input type="password" class="form-control" wire:model="password" name="password"
                                        id="password" aria-describedby="helpId" placeholder="enter password" />

                                    @error("password")
                                        <small id="helpId" class="form-text text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Submit
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    @endvolt
</x-admin-layout>
