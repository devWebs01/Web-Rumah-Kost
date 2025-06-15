<?php

use function Livewire\Volt\{state};
use App\Models\{Room};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

state([
    "user" => Auth::user(),
    "rooms" => fn() => $this->user->boardingHouse->rooms ?? null,
]);

$unavailable = function (Room $room) {
    $room->update([
        "status" => "unavailable",
    ]);

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("boardingHouse.index");
};

$available = function (Room $room) {
    $room->update([
        "status" => "available",
    ]);

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("boardingHouse.index");
};

$destroy = function (Room $room) {
    $room->delete();

    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("boardingHouse.index");
};

?>

@volt
    <div>
        @include("components.partials.datatable")

        @if ($rooms)
            <div>
                <div class="card border">
                    <h4 class="text-center fw-semibold text-decoration-underline mt-3">Data Kamar</h4>
                    <div class="card-body">
                        <a class="btn btn-primary mb-3" href="{{ route("rooms.create") }}" role="button">Tambah Data</a>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nomor Kamar</th>
                                        <th>Nomor Kamar</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Ukuran</th>
                                        <th>Ganti Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $no => $room)
                                        <tr>
                                            <td>{{ ++$no }} </td>
                                            <td>Kamar {{ $room->room_number }}</td>
                                            <td>{{ formatRupiah($room->price) }}</td>
                                            <td>
                                                <span class="badge bg-primary">
                                                    {{ __("room_status." . $room->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $room->size }}</td>
                                            <td>
                                                @if ($room->status === "available")
                                                    <button type="button" class="btn btn-dark btn-sm"
                                                        wire:click='unavailable({{ $room }})'>
                                                        Tidak Tersedia
                                                    </button>
                                                @elseif($room->status === "unavailable")
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        wire:click='available({{ $room }})'>
                                                        Tersedia
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-3 justify-content-center">

                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route("rooms.edit", ["room" => $room->id]) }}"
                                                        role="button">Edit</a>

                                                    <button role="button" wire:click="destroy({{ $room }})"
                                                        class="btn btn-danger btn-sm">Hapus</button>

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
        @endif

    </div>
@endvolt
