<?php

use function Livewire\Volt\{state};
use App\Models\{Comment};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use function Laravel\Folio\{name};

name("admin.comments.index");

state([
    "comments" => fn() => Comment::get() ?? collect(),
]);

$toggleStatus = function ($commentId) {
    $comment = Comment::findOrFail($commentId);
    $comment->status = !$comment->status; // Toggle status
    $comment->save();

    $this->redirectRoute("admin.comments.index");
};

$delete = function ($commentId) {
    $comment = Comment::findOrFail($commentId);
    $comment->delete();
    $this->redirectRoute("admin.comments.index");
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

            <div class="card border">
                <h4 class="text-center fw-semibold text-decoration-underline mt-3">Data Komentar</h4>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>Komentar</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Opsi</th>
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
                                            @for ($i = 0; $i < $comment->rating; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill text-warning"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            @endfor

                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="commentSwitch{{ $comment->id }}"
                                                    wire:change="toggleStatus({{ $comment->id }})"
                                                    @if ($comment->status) checked @endif>
                                                <label class="form-check-label" for="commentSwitch{{ $comment->id }}">
                                                    {{ $comment->status ? "Aktif" : "Non-Aktif" }}
                                                </label>
                                            </div>
                                        </td>

                                        <td>
                                            {{ $comment->created_at->translatedFormat("d F Y, H:i") }}
                                        </td>
                                        <td>
                                            <button type="button" wire:click='delete({{ $comment->id }})'
                                                class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>

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
