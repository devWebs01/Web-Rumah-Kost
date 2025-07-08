<?php

use function Livewire\Volt\{state, mount, placeholder};
use App\Models\{WebsiteSystem};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use function Laravel\Folio\{name};
placeholder("<div>Loading...</div>");

name("website_system.show");

state([
    "websiteSystem" => null,
    "name" => "",
    "facebook" => "",
    "twitter" => "",
    "instagram" => "",
    "phone_number" => "",
    "whatsapp_number" => "",
]);

mount(function () {
    $websiteSystem = WebsiteSystem::first();
    $this->websiteSystem = $websiteSystem;

    if ($websiteSystem) {
        $this->name = $websiteSystem->name;
        $this->facebook = $websiteSystem->facebook;
        $this->twitter = $websiteSystem->twitter;
        $this->instagram = $websiteSystem->instagram;
        $this->phone_number = $websiteSystem->phone_number;
        $this->whatsapp_number = $websiteSystem->whatsapp_number;
    }
});

$update = function () {
    $this->validate([
        "name" => "required|string|max:255",
        "facebook" => "nullable|url",
        "twitter" => "nullable|url",
        "instagram" => "nullable|url",
        "phone_number" => "nullable|string|max:20",
        "whatsapp_number" => "nullable|string|max:20",
    ]);

    $this->websiteSystem->update([
        "name" => $this->name,
        "facebook" => $this->facebook,
        "twitter" => $this->twitter,
        "instagram" => $this->instagram,
        "phone_number" => $this->phone_number,
        "whatsapp_number" => $this->whatsapp_number,
    ]);

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("website_system.show");
};

?>

<x-panel-layout>
    <x-slot name="title">Data Sistem</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="#">Data Sistem</a>
        </li>
    </x-slot>
    @volt
        <div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Data Website</h5>
                    <div class="alert alert-info py-1 px-2 mb-0" role="alert" style="font-size: 0.9rem;">
                        Perbarui informasi website <span data-bs-toggle="tooltip"
                            title="Informasi ini akan muncul di bagian footer dan kontak publik.">ℹ️</span>
                    </div>
                </div>

                <div class="card-body">
                    <form wire:submit="update">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Nama Website
                                    <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip"
                                        title="Nama brand utama website."></i>
                                </label>
                                <input type="text" wire:model="name" class="form-control" />
                                @error("name")
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Nomor Telepon
                                    <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip"
                                        title="Nomor kontak yang dapat dihubungi."></i>
                                </label>
                                <input type="text" wire:model="phone_number" class="form-control" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Nomor WhatsApp
                                    <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip"
                                        title="Pastikan nomor aktif dan terdaftar di WhatsApp."></i>
                                </label>
                                <input type="text" wire:model="whatsapp_number" class="form-control" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Facebook
                                    <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip"
                                        title="Masukkan URL lengkap, contoh: https://facebook.com/nama-page"></i>
                                </label>
                                <input type="url" wire:model="facebook" class="form-control" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Twitter
                                    <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip"
                                        title="Masukkan URL profil Twitter."></i>
                                </label>
                                <input type="url" wire:model="twitter" class="form-control" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Instagram
                                    <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip"
                                        title="Masukkan link profil Instagram Anda."></i>
                                </label>
                                <input type="url" wire:model="instagram" class="form-control" />
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    @endvolt

</x-panel-layout>
