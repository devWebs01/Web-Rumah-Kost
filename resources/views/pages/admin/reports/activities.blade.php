<?php

use Spatie\Activitylog\Models\Activity;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};

name("reports.activities");

state([
    "activities" => fn() => Activity::latest()->get(),
]);

?>

<x-panel-layout>
    <x-slot name="title">Data Admin</x-slot>
    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="{{ route("reports.activities") }}">
                Log Aktifitas User
            </a>
        </li>

    </x-slot>

    @include("components.partials.print")
    @volt
        <div>
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table text-nowrap table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Deskripsi</th>
                                    <th>Model Terkait</th>
                                    <th>Pelaku</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $i => $log)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $log->description }}</td>
                                        <td>{{ class_basename($log->subject_type) }}</td>
                                        <td>{{ $log->causer?->name ?? "System" }}</td>
                                        <td>{{ $log->created_at->format("d M Y H:i") }}</td>
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
