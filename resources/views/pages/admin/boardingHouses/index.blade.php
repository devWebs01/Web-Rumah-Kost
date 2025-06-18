<?php

use App\Models\BoardingHouse;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

name("boardingHouses.index");

state([
    "boardingHouses" => fn() => BoardingHouse::latest()->get(),
]);

$verified = function (BoardingHouse $boardingHouse) {
    $boardingHouse->update([
        "verification_status" => "verified",
    ]);

    try {
        $owner = $boardingHouse->owner;

        if ($owner && $owner->identity && $owner->identity->whatsapp_number) {
            $message = implode("\n", ["📢 *Verifikasi Kos Berhasil!*", "", "Kos milik Anda dengan data berikut telah *lolos verifikasi* oleh admin.", formatField("Nama Kos", $boardingHouse->name), formatField("Kategori", __("category." . $boardingHouse->category)), formatField("Alamat", $boardingHouse->address), "", "Kos Anda kini bisa ditampilkan dan dicari oleh calon penyewa.", "Terima kasih telah menggunakan layanan kami."]);

            (new \App\Services\FonnteService())->send($owner->identity->whatsapp_number, $message);
        }
    } catch (\Throwable $e) {
        activity()
            ->causedBy(Auth::user())
            ->withProperties([
                "exception" => $e->getMessage(),
                "boarding_house_id" => $boardingHouse->id,
                "owner" => $owner->email ?? null,
            ])
            ->log("Gagal mengirim notifikasi WA verifikasi kos ke pemilik.");
    }

    // Log spesifik verifikasi
    activity()
        ->causedBy(Auth::user())
        ->performedOn($boardingHouse)
        ->log("Kos '{$boardingHouse->name}' telah *DITERIMA* oleh " . Auth::user()->name);

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();
    $this->redirectRoute("boardingHouses.index");
};

$rejected = function (BoardingHouse $boardingHouse) {
    $boardingHouse->update([
        "verification_status" => "rejected",
    ]);

    try {
        $owner = $boardingHouse->owner;

        if ($owner && $owner->identity && $owner->identity->whatsapp_number) {
            $message = implode("\n", ["⚠️ *Verifikasi Kos Ditolak*", "", "Kos milik Anda *tidak lolos verifikasi* oleh admin.", formatField("Nama Kos", $boardingHouse->name), formatField("Kategori", __("category." . $boardingHouse->category)), formatField("Alamat", $boardingHouse->address), "", "Silakan periksa kembali data kos Anda dan lakukan perbaikan jika diperlukan.", "Jika ada pertanyaan, silakan hubungi admin."]);

            (new \App\Services\FonnteService())->send($owner->identity->whatsapp_number, $message);
        }
    } catch (\Throwable $e) {
        activity()
            ->causedBy(Auth::user())
            ->withProperties([
                "exception" => $e->getMessage(),
                "boarding_house_id" => $boardingHouse->id,
                "owner" => $owner->email ?? null,
            ])
            ->log("Gagal mengirim notifikasi WA penolakan kos ke pemilik.");
    }

    // Log spesifik verifikasi
    activity()
        ->causedBy(Auth::user())
        ->performedOn($boardingHouse)
        ->log("Kos '{$boardingHouse->name}' telah *DITOLAK* oleh " . Auth::user()->name);

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();
    $this->redirectRoute("boardingHouses.index");
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

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-nowrap">
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
                                                class="img rounded object-fit-cover" width="50" height="50"
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
                                                <!-- Tombol Verifikasi: tampilkan saat status ≠ 'verified' -->
                                                <button type="button" wire:click="verified({{ $boardingHouse->id }})"
                                                    class="btn btn-success btn-sm {{ $boardingHouse->verification_status === "verified" ? "d-none" : "" }}">
                                                    Verifikasi
                                                </button>

                                                <!-- Tombol Lihat (selalu tampil) -->
                                                <a href="{{ route("boardingHouses.show", ["boardingHouse" => $boardingHouse->id]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    Lihat
                                                </a>

                                                <!-- Tombol Tolak: tampilkan saat status ≠ 'rejected' -->
                                                <button type="button" wire:click="rejected({{ $boardingHouse->id }})"
                                                    class="btn btn-danger btn-sm {{ $boardingHouse->verification_status === "rejected" ? "d-none" : "" }}">
                                                    Tolak
                                                </button>

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
