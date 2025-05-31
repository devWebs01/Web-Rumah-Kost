<?php

use App\Models\{User, Identity};
use function Livewire\Volt\{state, usesFileUploads};
use function Laravel\Folio\{name};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

usesFileUploads();

name("owners.create");

state(["name", "email", "password", "phone_number", "whatsapp_number", "id_card", "address"]);

$create = function () {
    $validatedUser = $this->validate([
        "name" => "required|min:5|string|max:100",
        "email" => "required|email|min:5|max:255|unique:users,email",
        "password" => "required|min:5|string", // Gunakan 'confirmed' jika ada field password_confirmation
    ]);

    $validatedUser["password"] = bcrypt($this->password);
    $validatedUser["role"] = "owner";
    $user = User::create($validatedUser);

    $validatedIdentity = $this->validate([
        "phone_number" => "required|digits_between:10,15",
        "whatsapp_number" => "nullable|digits_between:10,15",
        "id_card" => "required|image|mimes:jpeg,png,jpg", // Maks. 2MB
        "address" => "required|string|min:10|max:255",
    ]);

    $validatedIdentity["id_card"] = $this->id_card->store("identities", "public");

    // Hubungkan identitas dengan user (asumsi: relasi user -> identity)
    $user->identity()->create($validatedIdentity);

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("owners.index");
};

?>

<x-panel-layout>
    <x-slot name="title">Edit Data</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="{{ route("owners.index") }}">
                Pemilik Kost
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">
                Tambah Data
            </a>
        </li>

    </x-slot>

    @volt
        <div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form wire:submit="create">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Nama</label>
                                            <input type="text" class="form-control" wire:model.blur="name" name="name"
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
                                            <input type="email" class="form-control" wire:model.blur="email"
                                                name="email" id="email" aria-describedby="helpId"
                                                placeholder="enter email" />

                                            @error("email")
                                                <small id="helpId" class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="password" class="form-label">Kata Sandi</label>
                                            <input type="password" class="form-control" wire:model.blur="password"
                                                name="password" id="password" aria-describedby="helpId"
                                                placeholder="enter password" />

                                            @error("password")
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
                                                placeholder="enter phone_number" />

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
                                                placeholder="enter whatsapp_number" />

                                            @error("whatsapp_number")
                                                <small id="helpId" class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="id_card" class="form-label">
                                                Identitas (KTP)
                                            </label>
                                            <input type="file" class="form-control" wire:model.blur="id_card"
                                                name="id_card" id="id_card" aria-describedby="helpId"
                                                placeholder="enter id_card" accept="image/*" />

                                            @error("id_card")
                                                <small id="helpId" class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="address" class="form-label">Alamat</label>
                                            <textarea wire:model.blur="address" class="form-control" name="address" id="address" rows="4">

                                            </textarea>
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body p-4">
                            <h4 class="card-title text-center mb-3">User Profile</h4>
                            <div class="text-center">
                                <img src="{{ "https://api.dicebear.com/9.x/adventurer/svg?seed=" . $name ?? "https://api.dicebear.com/9.x/adventurer/svg?seed=Mason" }}"
                                    alt="modernize-img" class="img-fluid rounded-circle mb-4 border" width="120"
                                    height="120">
                            </div>

                            <div class="row mb-2">
                                <div class="col-4 text-end fw-bold">Nama:</div>
                                <div class="col-8 mb-1">{{ $name ?? "-" }}</div>

                                <div class="col-4 text-end fw-bold">Email:</div>
                                <div class="col-8 mb-1">{{ $email ?? "-" }}</div>

                                <div class="col-4 text-end fw-bold">Telp:</div>
                                <div class="col-8 mb-1">{{ $phone_number ?? "-" }}</div>

                                <div class="col-4 text-end fw-bold">WA:</div>
                                <div class="col-8 mb-1">{{ $whatsapp_number ?? "-" }}</div>

                                <div class="col-4 text-end fw-bold">Alamat:</div>
                                <div class="col-8 mb-1">{{ $address ?? "-" }}</div>
                            </div>
                        </div>
                    </div>

                    @if ($id_card)
                        <div class="card">
                            <a href="{{ $id_card->temporaryUrl() }}" data-fancybox data-caption="Single image">
                                <img src="{{ $id_card->temporaryUrl() }}" class="card-img-top rounded" alt="id card"
                                    width="150" height="150" style="object-fit: cover;" />
                            </a>

                        </div>
                    @endif

                </div>
            </div>

        </div>
    @endvolt
</x-panel-layout>
