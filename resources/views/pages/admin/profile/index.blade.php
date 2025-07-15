<?php

use App\Models\User;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

use function Livewire\Volt\{state, usesFileUploads};
use function Laravel\Folio\{name, middleware};

middleware(["auth"]);

usesFileUploads();

name("profile.admin");

state([
    "user" => fn() => Auth::User(),
    "name" => fn() => $this->user->name,
    "email" => fn() => $this->user->email,
    "password",

    // identity
    "identity" => fn() => $this->user->identity ?? null,
    "phone_number" => fn() => $this->identity->phone_number ?? null,
    "whatsapp_number" => fn() => $this->identity->whatsapp_number ?? null,
    "address" => fn() => $this->identity->address ?? null,
    "user_id" => fn() => $this->identity->user_id ?? null,
]);

$updateUser = function () {
    $user = $this->user;

    $validated = $this->validate([
        // User fields
        "name" => ["required", "min:5"],
        "email" => ["required", "email", "min:5", Rule::unique(User::class)->ignore($user->id)],
        "password" => ["nullable", "min:5"],

        // Identity fields
        "phone_number" => ["required", "digits_between:10,15"],
        "whatsapp_number" => ["required", "digits_between:10,15"],
        "address" => ["required", "string", "min:10", "max:255"],
    ]);

    // Proses data user
    $userData = [
        "name" => $validated["name"],
        "email" => $validated["email"],
    ];

    if (!empty($validated["password"])) {
        $userData["password"] = bcrypt($validated["password"]);
    }

    $user->update($userData);

    // Proses data identity
    $identityData = [
        "phone_number" => $validated["phone_number"],
        "whatsapp_number" => $validated["whatsapp_number"] ?? null,
        "address" => $validated["address"],
    ];


    $user->identity()->updateOrCreate(["user_id" => $user->id], $identityData);

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("profile.admin");
};

?>

<x-panel-layout>
    <x-slot name="title">Data Profil</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="#">
                Profil Saya
            </a>
        </li>

    </x-slot>

    @volt
        <div>
            <x-slot name="title">{{ $user->name }}</x-slot>

            <div>
                <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                    <div class="card-body px-4 py-3">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h4 class="fw-semibold mb-8">Data Profil Akun</h4>
                                <p class="text-muted mb-4 fs-6">
                                    Pada halaman update pengguna, kamu dapat mengubah informasi pengguna.
                                </p>
                            </div>
                            <div class="col-3">
                                <div class="text-center mb-n5">
                                    <img src="https://ouch-prod-var-cdn.icons8.com/iy/illustrations/thumbs/HX8M3yKf5cJ8K1f1.webp"
                                        alt="modernize-img" class="img-fluid w-50 mb-n4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-0">

                    <div class="card-body border rounded">
                        <form class="row" wire:submit='updateUser' method="POST" enctype="multipart/form-data">

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" wire:model="name" required>
                                @error("name")
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" name="email" class="form-control" wire:model="email" required>
                                @error("email")
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="password" class="form-label">Password (Kosongkan jika tidak ingin
                                    mengubah)</label>
                                <input type="password" name="password" class="form-control" wire:model="password">
                                @error("password")
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone_number" class="form-label">Nomor Telepon</label>
                                <input type="number" name="phone_number" class="form-control" wire:model="phone_number">
                                @error("phone_number")
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="whatsapp_number" class="form-label">Nomor WhatsApp</label>
                                <input type="number" name="whatsapp_number" class="form-control"
                                    wire:model="whatsapp_number">
                                @error("whatsapp_number")
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="address" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" name="address" wire:model='address' id="address" rows="3">{{ $address }}</textarea>
                                @error("address")
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Update Data</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    @endvolt
</x-panel-layout>
