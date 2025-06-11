<?php

use App\Models\Transaction;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};
use Carbon\Carbon;

name("transactions.index");

state([
    "transactions" => fn() => Transaction::where("user_id", Auth::id())
        ->get()
        ->map(function ($trx) {
            $trx->statusClass =
                [
                    "pending" => "bg-warning",
                    "confirmed" => "bg-success",
                    "cancelled" => "bg-danger",
                ][$trx->status] ?? "bg-secondary";

            return $trx;
        }),
]);
?>

<x-guest-layout>

    @include("components.partials.datatable")

    @volt
        <div class="container my-5">
            <div class="card border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kos</th>
                                    <th>Status</th>
                                    <th>Tanggal Mulai Sewa</th>
                                    <th>Total</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $no => $transaction)
                                    <tr>
                                        <td>{{ ++$no }}.. </td>
                                        <td>{{ $transaction->room->boardingHouse->name }}</td>
                                        <td>
                                            <span class="badge {{ $transaction->statusClass }}">
                                                {{ __("transaction_status." . $transaction->status) }}
                                            </span>
                                        </td>
                                        <td>{{ Carbon::parse($transaction->check_in)->diffInMonths($transaction->check_out) }}
                                            Bulan
                                        </td>
                                        <td>{{ formatRUpiah($transaction->total) }}</td>
                                        <td>
                                            <div class="d-grid gap-2">
                                                <button type="button" class="btn btn-primary btn-sm">
                                                    Button
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
</x-guest-layout>
