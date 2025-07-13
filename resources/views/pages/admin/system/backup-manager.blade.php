<?php

use function Livewire\Volt\{state, mount, action};
use Illuminate\Support\Facades\{Artisan, Storage};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use function Laravel\Folio\{name};

name("admin.backups");

state([
    "backups" => [],
]);

mount(function () {
    $this->loadBackups();
});

$loadBackups = function () {
    $disk = Storage::disk(config("backup.backup.destination.disks")[0]);
    $files = $disk->files(config("backup.backup.name"));

    $this->backups = collect($files)
        ->map(function ($file) use ($disk) {
            return [
                "file_path" => $file,
                "file_name" => basename($file),
                "file_size" => $disk->size($file),
                "last_modified" => $disk->lastModified($file),
            ];
        })
        ->sortByDesc("last_modified")
        ->values()
        ->all();
};

$createBackup = function () {
    Artisan::call("db:seed --class=BackupSeeder");
    Artisan::call("queue:work --once");

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("admin.backups");
};

$downloadBackup = function ($fileName) {
    $disk = Storage::disk(config("backup.backup.destination.disks")[0]);
    return response()->streamDownload(function () use ($disk, $fileName) {
        echo $disk->get(config("backup.backup.name") . "/" . $fileName);
    }, $fileName);
};



?>
<x-panel-layout>
    <x-slot name="title">Data Komentar</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="#">Data Komentar</a>
        </li>
    </x-slot>
    @volt
        <div>
            @include("components.partials.datatable")

            <div class="d-flex justify-content-start mb-3">
                <button wire:click='createBackup' class="btn btn-primary">Buat Backup</button>
            </div>
            <div class="card" wire:ignore>
                <div class="card-body ">
                    <h5 class="card-title">Backups</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>File Name</th>
                                    <th>File Size</th>
                                    <th>Last Modified</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($backups as $key => $backup)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $backup["file_name"] }}</td>
                                        <td>{{ round($backup["file_size"] / 1024 / 1024, 2) }} MB</td>
                                        <td>{{ date("Y-m-d H:i:s", $backup["last_modified"]) }}</td>
                                        <td>
                                            <button wire:click="downloadBackup('{{ $backup["file_name"] }}')"
                                                class="btn btn-sm btn-success">Download</button>

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
