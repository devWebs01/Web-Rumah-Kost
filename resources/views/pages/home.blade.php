<?php

use App\Models\User;
use App\Models\BoardingHouse;
use Illuminate\Support\Facades\Auth;
use function Livewire\Volt\{state, mount};
use function Laravel\Folio\{name};

name("home");

state([
    "totalKos" => fn() => BoardingHouse::count(),
    "registrations" => fn() => User::selectRaw("DATE(created_at) as date, COUNT(*) as total")
        ->whereBetween("created_at", [now()->subDays(30), now()])
        ->groupBy("date")
        ->orderBy("date")
        ->get(),
    "boardingHouses" => fn() => BoardingHouse::where("owner_id", Auth::User()->id)->get(),
    "data" => fn() => $this->boardingHouses->map(function ($kos) {
        return [
            "name" => $kos->name,
            "total_kamar" => $kos->rooms->count(),
            "tersedia" => $kos->rooms->where("status", "available")->count(),
            "terisi" => $kos->rooms->where("status", "!=", "available")->count(),
        ];
    }),
]);

?>

<x-panel-layout>
    <x-slot name="title">Dashboard</x-slot>

    @volt
        <div>
            <div class="container py-4">
                @if (Auth::User()->role === "admin")
                    <div class="p-4">
                        <h4>Total Kos Terdaftar: {{ $totalKos }}</h4>

                        <div class="mt-4">
                            <canvas id="registrationChart"></canvas>
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
                @else
                    <div class="p-4">
                        <h4>Data Kos Anda</h4>

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
                @endif
            </div>
        </div>
    @endvolt

</x-panel-layout>
