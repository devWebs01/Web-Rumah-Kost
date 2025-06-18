<?php

use App\Models\Transaction;
use function Livewire\Volt\{state};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use function Laravel\Folio\{name};

name("owner.transactions.index");

state([
    "user" => Auth::user(),
    "transactions" => fn() => optional($this->user->boardingHouse)?->id ? Transaction::where("boarding_house_id", $this->user->boardingHouse->id)->get() : collect(),

    "useTransactionChart" => fn() => \App\Models\Transaction::whereHas("boardingHouse", fn($q) => $q->where("owner_id", Auth::id()))->selectRaw("DATE(check_in) as date, COUNT(*) as total")->groupBy("date")->orderBy("date")->get(),
]);

?>

<x-panel-layout>
    <x-slot name="title">Menu Transaksi</x-slot>

    <x-slot name="header">
        <li class="breadcrumb-item">
            <a href="{{ route("transactions.index") }}">Data Transaksi</a>
        </li>
    </x-slot>

    @volt
        <div>
            <div class="card border mt-4">
                <h4 class="text-center fw-semibold text-decoration-underline mt-3">Grafik Pemesanan Berdasarkan Tanggal</h4>
                <div class="card-body">
                    <canvas id="transactionChart"></canvas>
                </div>
            </div>

            <div class="card border">
                <h4 class="text-center fw-semibold text-decoration-underline mt-3">Data Transaksi</h4>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Keluar</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $no => $transaction)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $transaction->code }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->check_in)->format("d M Y") }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->check_out)->format("d M Y") }}</td>
                                        <td>{{ formatRupiah($transaction->total) }}</td>
                                        <td>
                                            <span class="badge bg-primary">
                                                {{ __("transaction_status." . $transaction->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <!-- Tombol aksi seperti detail, konfirmasi, dll -->
                                            <a href="{{ route("owner.transactions.show", ["transaction" => $transaction->id]) }}"
                                                class="btn btn-sm btn-info">Detail</a>
                                        </td>
                                    </tr>
                                    @if ($transactions === null)
                                        <tr>
                                            <td colspan="7"> tidak ada</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const chartData = @json($useTransactionChart);
                const labels = chartData.map(item => item.date);
                const data = chartData.map(item => item.total);

                new Chart(document.getElementById("transactionChart"), {
                    type: "line",
                    data: {
                        labels,
                        datasets: [{
                            label: "Jumlah Pemesanan",
                            data,
                            backgroundColor: "rgba(54, 162, 235, 0.2)",
                            borderColor: "rgba(54, 162, 235, 1)",
                            borderWidth: 2,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: "Jumlah Transaksi"
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: "Tanggal"
                                }
                            }
                        }
                    }
                });
            </script>
        </div>
    @endvolt
</x-panel-layout>
