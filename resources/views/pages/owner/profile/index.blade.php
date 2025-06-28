<?php

use App\Models\User;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

use function Livewire\Volt\{state, usesFileUploads};
use function Laravel\Folio\{name, middleware};

middleware(["auth"]);

usesFileUploads();

name("profile.owner");

state([
    "user" => fn() => Auth::User(),
    "name" => fn() => $this->user->name,
    "email" => fn() => $this->user->email,
    "password",

    // identity
    "identity" => fn() => $this->user->identity ?? null,
    "phone_number" => fn() => $this->identity->phone_number ?? null,
    "whatsapp_number" => fn() => $this->identity->whatsapp_number ?? null,
    "id_card",
    "address" => fn() => $this->identity->address ?? null,
    "user_id" => fn() => $this->identity->user_id ?? null,
]);

$edit = function (): void {
    $user = $this->user;

    $validatedUser = $this->validate([
        "name" => "required|min:5",
        "email" => "required|min:5|" . Rule::unique(User::class)->ignore($user->id),
        "password" => "min:5|nullable",
    ]);

    $user = $this->user;

    // Jika wire:model password terisi, lakukan update password
    if (!empty($this->password)) {
        $validatedUser["password"] = bcrypt($this->password);
    } else {
        // Jika wire:model password tidak terisi, gunakan password yang lama
        $validatedUser["password"] = $user->password;
    }

    $user->update($validatedUser);

    $this->validate([
        "phone_number" => "required|digits_between:10,15",
        "whatsapp_number" => "nullable|digits_between:10,15",
        "id_card" => "nullable|image|mimes:jpeg,png,jpg|max:2048", // max 2MB
        "address" => "required|string|min:10|max:255",
    ]);

    $identityData = $this->only("phone_number", "whatsapp_number", "address");

    // Simpan file jika ada
    if ($this->id_card) {
        $idCardPath = $this->id_card->store("id_cards", "public");
        $identityData["id_card"] = $idCardPath;
    }

    // Buat atau update identity
    $user->identity()->updateOrCreate(
        ["user_id" => $user->id], // key pencarian
        $identityData, // data yang diisi atau diperbarui
    );
    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("profile.owner");
};

?>

<x-panel-layout>
    <x-slot name="title">Profil Akun</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="#">Profil Akun</a>
        </li>
    </x-slot>

    @volt
        <div>
            <x-slot name="title">{{ $user->name }}</x-slot>

            <div class="container mt-5">
                <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                    <div class="card-body px-4 py-3">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h4 class="fw-semibold mb-8">Data Profil Akun</h4>
                                <p class="text-muted mb-4 fs-6">
                                    Pada halaman profil akun, kamu dapat mengubah informasi pengguna.
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
                        <form class="row" wire:submit='edit' method="POST" enctype="multipart/form-data">

                            <h4 class="fw-bold mb-3">Data Akun</h4>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" wire:model="name" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" name="email" class="form-control" wire:model="email" required>
                            </div>

                            <div class="col-md mb-3">
                                <label for="password" class="form-label">Password (Kosongkan jika tidak ingin
                                    mengubah)</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <h4 class="fw-bold mb-3">Data Identitas</h4>

                            <div class="row">
                                <div class="col-lg-8">

                                    <div class="col-md-12 mb-3">
                                        <label for="phone_number" class="form-label">Nomor Telepon</label>
                                        <input type="number" name="phone_number" class="form-control"
                                            wire:model="phone_number">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="whatsapp_number" class="form-label">Nomor WhatsApp</label>
                                        <input type="number" name="whatsapp_number" class="form-control"
                                            wire:model="whatsapp_number">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="id_card" class="form-label">Nomor WhatsApp</label>
                                        <input type="file" name="id_card" class="form-control" wire:model="id_card">
                                    </div>

                                </div>
                                <div class="col-lg">
                                    @if ($id_card)
                                        <img src="{{ $id_card->temporaryUrl() }}" class="img rounded-4" width="100%"
                                            height="280px" alt="id_card" />
                                    @else
                                        <img src="{{ !empty($identity->id_card) ? Storage::url($identity->id_card) : "https://dummyimage.com/600x400/000/bfbfbf&text=silahkan+tambahkan+id+card" }}"
                                            class="img rounded-4" width="100%" height="280px" alt="id_card" />
                                    @endif

                                </div>
                                <div class="col-12 mb-3">
                                    <label for="address" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" name="address" wire:model='address' id="address" rows="3">{{ $address }}</textarea>
                                </div>
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
