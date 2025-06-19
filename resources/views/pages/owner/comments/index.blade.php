<?php

use function Livewire\Volt\{state};
use App\Models\{Room};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use function Laravel\Folio\{name};

name("owner.comments.index");

state([
    "user" => Auth::user(),
    "comments" => fn() => $this->user->boardingHouse->comments ?? collect(),
]);

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

            <div class="card border">
                <h4 class="text-center fw-semibold text-decoration-underline mt-3">Data Komentar</h4>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>Komentar</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $i => $comment)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $comment->user->name }}</td>
                                        <td>
                                            {{ $comment->body }}
                                        </td>
                                        <td>
                                            @for ($j = 0; $j < $comment->rating; $j++)
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @endfor
                                        </td>
                                        <td>
                                            {{ $comment->deleted_at ? "Dihapus" : "Aktif" }}
                                        </td>
                                        <td>
                                            {{ $comment->created_at->translatedFormat("d F Y, H:i") }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    @endvolt

</x-panel-layout>
