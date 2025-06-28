<?php

use App\Models\User;
use function Livewire\Volt\{state, usesFileUploads};
use function Laravel\Folio\{name};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

usesFileUploads();

name("admins.edit");

state([
    "name" => fn() => $this->user->name,
    "email" => fn() => $this->user->email,
    "phone_number" => fn() => $this->user->identity->phone_number ?? null,
    "whatsapp_number" => fn() => $this->user->identity->whatsapp_number ?? null,
    "address" => fn() => $this->user->identity->address ?? null,
    "id_card",
    "password",
    "user",
    "logs" => fn() => \Spatie\Activitylog\Models\Activity::where("causer_id", $this->user->id)->latest()->take(10)->get(),
]);

$update = function (): void {
    $user = $this->user;

    // Validasi data user
    $validatedUser = $this->validate([
        "name" => "required|min:5|string|max:100",
        "email" => "required|email|min:5|max:255|unique:users,email," . $user->id,
        "password" => "nullable|min:5|string",
    ]);

    // Jika password diisi, enkripsi, kalau tidak, hapus dari array
    if (!empty($validatedUser["password"])) {
        $validatedUser["password"] = bcrypt($validatedUser["password"]);
    } else {
        unset($validatedUser["password"]);
    }

    // Update data user
    $user->update($validatedUser);

    // Validasi data identitas
    $validatedIdentity = $this->validate([
        "phone_number" => "required|digits_between:10,15",
        "whatsapp_number" => "nullable|digits_between:10,15",
        "id_card" => "nullable|image|mimes:jpeg,png,jpg",
        "address" => "required|string|min:10|max:255",
    ]);

    // Update file id_card jika ada yang baru diupload
    if ($this->id_card) {
        // Optional: hapus file lama
        if ($user->identity && $user->identity->id_card) {
            Storage::delete($user->identity->id_card); // pastikan disk sesuai
        }

        $validatedIdentity["id_card"] = $this->id_card->store("identities", "public");
    }

    // Update atau buat relasi identity
    if ($user->identity) {
        $user->identity->update($validatedIdentity);
    } else {
        $user->identity()->create($validatedIdentity);
    }

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("owners.index");
};

?>

<x-panel-layout>
    <x-slot name="title">Edit Data</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="{{ route("owners.index") }}">
                Pemilik Kos
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">
                Edit Data
            </a>
        </li>

    </x-slot>

    @include("components.partials.fancybox")
    @volt
        <div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form wire:submit="update">
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
                                            <input type="file" class="form-control" wire:model="id_card" name="id_card"
                                                id="id_card" aria-describedby="helpId" placeholder="enter id_card"
                                                accept="image/*" />

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
{{ $address }}
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

                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Aktivitas Pengguna</h5>

                            @if ($logs->count())
                                <ul class="list-group list-group-flush">
                                    @foreach ($logs as $log)
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <strong>{{ $log->description }}</strong><br>
                                                    <small class="text-muted">
                                                        {{ \Carbon\Carbon::parse($log->created_at)->translatedFormat("d M Y H:i") }}
                                                    </small>
                                                </div>
                                                @if ($log->subject_type)
                                                    <small class="text-muted text-end">
                                                        <em>{{ class_basename($log->subject_type) }}</em>
                                                    </small>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">Belum ada aktivitas tercatat.</p>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <!-- Flip Card: User Profile -->
                    <div id="identity" class="flip-card"
                        onclick="document.getElementById('identity').classList.toggle('flipped')">
                        <div class="flip-card-inner">
                            <!-- FRONT SIDE: Data Diri -->
                            <div class="flip-card-front p-4">
                                <h4 class="card-title text-center mb-3">Profil Pengguna</h4>
                                <div class="text-center mb-3">
                                    <img src="{{ "https://api.dicebear.com/9.x/adventurer/svg?seed=" . ($name ?? "Mason") }}"
                                        alt="Avatar" class="img-fluid rounded-circle border" width="100"
                                        height="100">
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-end fw-bold">Nama:</div>
                                    <div class="col-8 mb-1">
                                        <div
                                            style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $name ?? "-" }}
                                        </div>
                                    </div>

                                    <div class="col-4 text-end fw-bold">Email:</div>
                                    <div class="col-8 mb-1">
                                        <div
                                            style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $email ?? "-" }}
                                        </div>
                                    </div>

                                    <div class="col-4 text-end fw-bold">Telp:</div>
                                    <div class="col-8 mb-1">
                                        <div
                                            style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $phone_number ?? "-" }}
                                        </div>
                                    </div>

                                    <div class="col-4 text-end fw-bold">WA:</div>
                                    <div class="col-8 mb-1">
                                        <div
                                            style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $whatsapp_number ?? "-" }}
                                        </div>
                                    </div>

                                    <div class="col-4 text-end fw-bold">Alamat:</div>
                                    <div class="col-8 mb-1">
                                        <div
                                            style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                            {{ $address ?? "-" }}
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- BACK SIDE: ID Card -->
                            <div class="flip-card-back d-flex justify-content-center align-items-center">
                                @if ($id_card)
                                    <a href="{{ $id_card->temporaryUrl() }}" data-fancybox data-caption="ID Card">
                                        <img src="{{ $id_card->temporaryUrl() }}" class="img-fluid rounded shadow"
                                            alt="ID Card" style="max-height: 200px; object-fit: contain;" />
                                    </a>
                                @elseif(!empty($user->identity->id_card))
                                    <a href="{{ Storage::url($user->identity->id_card) }}" data-fancybox
                                        data-caption="ID Card">
                                        <img src="{{ Storage::url($user->identity->id_card) }}"
                                            class="img-fluid rounded shadow" alt="ID Card"
                                            style="max-height: 200px; object-fit: contain;" />
                                    </a>
                                @else
                                    <p class="text-white text-center">ID Card belum tersedia</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endvolt
</x-panel-layout>
