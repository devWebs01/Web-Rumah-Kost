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
            <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">Daftar Transaksi Anda</h4>
                            <p class="text-muted mb-4 fs-6">
                                Lihat riwayat transaksi kos Anda dengan mudah dan cepat. Kelola pembayaran dan status sewa
                                Anda di sini.
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="text-center mb-n5">
                                <img src="https://bootstrapdemos.adminmart.com/modernize/dist/assets/images/breadcrumb/ChatBc.png"
                                    alt="modernize-img" class="img-fluid mb-n4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg text-nowrap table-bordered rounded align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col" style="width: 5%;">No.</th>
                                    <th scope="col">Kos</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Mulai Sewa</th>
                                    <th scope="col" class="text-end">Total</th>
                                    <th scope="col" style="width: 10%;">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $no => $transaction)
                                    <tr>
                                        <td>{{ $no + 1 }}.</td>
                                        <td>{{ $transaction->room->boardingHouse->name }}</td>
                                        <td>
                                            <span class="badge {{ $transaction->statusClass }}">
                                                {{ __("transaction_status." . $transaction->status) }} </span>
                                        </td>
                                        <td>{{ Carbon::parse($transaction->check_in)->format("d M Y") }}</td>
                                        <td>{{ formatRupiah($transaction->total) }}</td>
                                        <td>
                                            <div class="d-grid gap-2">
                                                <a href="{{ route("transactions.show", ["transaction" => $transaction->id]) }}"
                                                    class="btn btn-primary btn-sm" title="Lihat Detail Transaksi">
                                                    Detail
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted fst-italic">
                                            Anda belum memiliki transaksi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                })
            });
        </script>
    @endvolt
</x-guest-layout>
