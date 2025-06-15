<?php

use App\Models\{User, Transaction, BoardingHouse};
use Illuminate\Support\Facades\Auth;
use function Livewire\Volt\{state, mount};
use function Laravel\Folio\{name};

name("home");

state([
    "totalKos" => fn() => Auth::user()->role === "admin" ? BoardingHouse::count() : BoardingHouse::where("owner_id", Auth::id())->count(),

    "registrations" => fn() => Auth::user()->role === "admin"
        ? User::selectRaw("DATE(created_at) as date, COUNT(*) as total")
            ->whereBetween("created_at", [now()->subDays(30), now()])
            ->groupBy("date")
            ->orderBy("date")
            ->get()
        : collect(), // Kosongkan jika bukan admin

    "boardingHouses" => fn() => BoardingHouse::where("owner_id", Auth::id())->with("rooms")->get(),

    "data" => fn() => Auth::user()->role === "owner"
        ? BoardingHouse::where("owner_id", Auth::id())
            ->with("rooms")
            ->get()
            ->map(function ($kos) {
                return [
                    "name" => $kos->name,
                    "total_kamar" => $kos->rooms->count(),
                    "tersedia" => $kos->rooms->where("status", "available")->count(),
                    "terisi" => $kos->rooms->where("status", "!=", "available")->count(),
                ];
            })
        : collect(), // Kosongkan jika bukan owner

    "kosByGender" => fn() => Auth::user()->role === "admin"
        ? [
            "Laki-laki" => BoardingHouse::where("category", "male")->count(),
            "Perempuan" => BoardingHouse::where("category", "female")->count(),
            "Campuran" => BoardingHouse::where("category", "mixed")->count(),
        ]
        : [],

    "boardingHousePending" => fn() => Auth::user()->role === "admin" ? BoardingHouse::where("verification_status", "pending")->get() : collect(),

    "transactions" => fn() => Auth::user()->role === "admin"
        ? Transaction::with(["boardingHouse", "user"])
            ->where("status", "pending")
            ->latest()
            ->get()
        : BoardingHouse::where("owner_id", Auth::id())
            ->with([
                "transactions" => function ($query) {
                    $query->where("status", "pending");
                },
            ])
            ->get()
            ->flatMap(fn($kos) => $kos->transactions),
]);

?>

<x-panel-layout>
    <x-slot name="title">Dashboard</x-slot>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @include("components.partials.datatable")

    @volt
        <div>
            <div class="py-4">
                @if (Auth::User()->role === "admin")
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card border">
                                <h4 class="text-center fw-semibold card-header">Total Kos Terdaftar</h4>
                                <div class="card-body">
                                    <div class="p-0">

                                        <div class="mt-4">
                                            <canvas id="registrationChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="card border">
                                <h4 class="text-center fw-semibold card-header">Distribusi Gender Kos</h4>
                                <div class="card-body">
                                    <div class="mt-8">
                                        <canvas id="genderDonutChart" class="mt-4"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border">
                        <h4 class="text-center fw-semibold card-header">Daftar Kos Butuh Verifikasi!</h4>

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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($boardingHousePending as $no => $pending)
                                            <tr>
                                                <td>{{ ++$no }}</td>
                                                <td>
                                                    <img src="{{ Storage::url($pending->thumbnail) }}"
                                                        class="img-fluid rounded object-fit-cover" width="50px"
                                                        height="50px" alt="thumbnail" />
                                                </td>
                                                <td>{{ $pending->name }}</td>
                                                <td>
                                                    {{ __("category." . $pending->category) }}
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary">
                                                        {{ __("verification_status." . $pending->verification_status) }}
                                                    </span>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <script>
                        const registrationData = @json($registrations);
                        const labels = registrationData.map(r => r.date);
                        const data = registrationData.map(r => r.total);

                        new Chart(document.getElementById('registrationChart'), {
                            type: 'line',
                            data: {
                                labels,
                                datasets: [{
                                    label: 'Pendaftaran User',
                                    data,
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    tension: 0.4
                                }]
                            }
                        });
                    </script>
                    <script>
                        const kosByGender = @json($kosByGender);
                        const genderLabels = Object.keys(kosByGender);
                        const genderCounts = Object.values(kosByGender);

                        new Chart(document.getElementById('genderDonutChart'), {
                            type: 'doughnut',
                            data: {
                                labels: genderLabels,
                                datasets: [{
                                    label: 'Jenis Kos',
                                    data: genderCounts,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                cutout: '60%', // agar jadi donat
                                plugins: {
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }
                        });
                    </script>
                @else
                    <div class="p-4 mb-3 border">
                        <h4 class="text-center fw-semibold text-decoration-underline mt-3">Data Kos Anda</h4>

                        <div class="mt-4">
                            <canvas id="kosChart"></canvas>
                        </div>
                    </div>

                    <script>
                        const kosData = @json($data);
                        const labels = kosData.map(k => k.name);
                        const tersedia = kosData.map(k => k.tersedia);
                        const terisi = kosData.map(k => k.terisi);

                        new Chart(document.getElementById('kosChart'), {
                            type: 'bar',
                            data: {
                                labels,
                                datasets: [{
                                        label: 'Kamar Tersedia',
                                        data: tersedia,
                                        backgroundColor: 'rgba(75, 192, 192, 0.6)'
                                    },
                                    {
                                        label: 'Kamar Terisi',
                                        data: terisi,
                                        backgroundColor: 'rgba(255, 99, 132, 0.6)'
                                    }
                                ]
                            }
                        });
                    </script>

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
                                                <td>{{ \Carbon\Carbon::parse($transaction->check_in)->format("d M Y") }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($transaction->check_out)->format("d M Y") }}
                                                </td>
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
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                @endif
            </div>

        </div>
    @endvolt

</x-panel-layout>
