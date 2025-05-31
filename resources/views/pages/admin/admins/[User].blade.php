<?php

use App\Models\User;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

name("admins.edit");

state([
    "name" => fn() => $this->user->name,
    "email" => fn() => $this->user->email,
    "password",
    "user",
]);

$update = function () {
    $user = $this->user;

    $validateData = $this->validate([
        "name" => "required|min:5",
        "email" => "required|min:5|" . Rule::unique(User::class)->ignore($user->id),
        "password" => "min:5|nullable",
    ]);
    $user = $this->user;

    // Jika wire:model password terisi, lakukan update password
    if (!empty($this->password)) {
        $validateData["password"] = bcrypt($this->password);
    } else {
        // Jika wire:model password tidak terisi, gunakan password yang lama
        $validateData["password"] = $user->password;
    }
    $user->update($validateData);

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("admins.index");
};

?>

<x-panel-layout>
    <x-slot name="title">Edit Data</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="{{ route("admins.index") }}">
                Admin
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">
                Edit Data
            </a>
        </li>
    </x-slot>

    @include("components.partials.datatable")
    @volt
        <div>
            <div class="card">
                <div class="card-body">
                    <form wire:submit="update">
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
</x-panel-layout>
