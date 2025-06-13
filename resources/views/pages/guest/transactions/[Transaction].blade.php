<?php
use App\Models\Transaction;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};

name("transactions.show");

state(["transaction"]);

// Dummy data untuk development/testing jika tidak ada data transaksi
// if (!isset($transaction)) {
//     $transaction = (object)[
//         'code' => 'TRX0012345',
//         'status' => 'paid',
//         'check_in' => '2023-05-10',
//         'check_out' => '2023-06-10',
//         'total' => 1500000,
//         'user' => (object)[
//             'name' => 'Budi Santoso',
//             'email' => 'budi.santoso@example.com',
//         ],
//         'room' => (object)[
//             'room_number' => 'A101',
//             'price' => 1500000,
//             'boardingHouse' => (object)[
//                 'name' => 'Kos Maju Jaya',
//                 'address' => 'Jl. Merdeka No. 45, Jakarta',
//             ],
//         ],
//     ];
// }

?>

<x-guest-layout>

    <style>
        .invoice-container {
            max-width: 900px;
            /* Lebar maksimum container */
            margin: 2rem auto;
            /* Margin atas/bawah dan tengah otomatis */
            padding: 2.5rem;
            /* Padding lebih besar */
            border: 1px solid #e0e0e0;
            /* Border lebih terang */
            border-radius: 12px;
            /* Sudut lebih membulat */
            background-color: #ffffff;
            /* Latar belakang putih */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            /* Bayangan lebih halus */
        }

        .invoice-header-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
            border-bottom: 3px solid #007bff;
            /* Garis bawah biru */
            padding-bottom: 1.5rem;
        }

        .invoice-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #343a40;
            /* Warna teks gelap */
        }

        .invoice-id-dates p {
            margin-bottom: 0.25rem;
            font-size: 0.95rem;
        }

        .section-title {
            font-size: 1.15rem;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .table-invoice th,
        .table-invoice td {
            padding: 0.8rem;
            vertical-align: middle;
        }

        .table-invoice th {
            background-color: #f0f8ff;
            /* Warna latar belakang header tabel */
            color: #007bff;
            font-weight: 600;
        }

        .table-invoice tbody tr:last-child {
            border-bottom: 1px solid #dee2e6;
        }

        .total-summary th,
        .total-summary td {
            padding: 0.6rem 0.8rem;
        }

        .total-summary th {
            text-align: end;
            font-weight: 500;
        }

        .total-summary .total-row {
            font-size: 1.4rem;
            font-weight: 700;
            color: #007bff;
            border-top: 2px solid #007bff;
        }

        .footer-info p {
            font-size: 0.9rem;
            color: #6c757d;
        }

        /* Print styles */
        @media print {
            body * {
                visibility: hidden;
            }

            .invoice-container,
            .invoice-container * {
                visibility: visible;
                -webkit-print-color-adjust: exact !important;
                /* Untuk mencetak warna latar belakang */
                color-adjust: exact !important;
            }

            .invoice-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                border: none;
                box-shadow: none;
                border-radius: 0;
            }

            .d-print-none {
                display: none !important;
            }
        }
    </style>
    @volt
        <div class="invoice-container mt-5 pt-5" id="invoice">

            <img src="https://placehold.co/100x40/007bff/ffffff?text=E-KOST" alt="Company Logo" class="img-fluid mb-3 rounded">
            <div class="invoice-header-top">
                <div>

                    <h1 class="invoice-title">Invoice Transaksi</h1>

                </div>
                <div class="text-end invoice-id-dates">
                    <p class="text-muted mb-0">Kode Transaksi: <span
                            class="fw-bold text-primary">{{ $transaction->code }}</span>
                    </p>
                    <p class="text-muted mb-0">Tanggal Transaksi: <span
                            class="fw-bold text-primary">{{ \Carbon\Carbon::parse($transaction->created_at)->format("d M Y") }}</span>
                    </p>

                </div>
            </div>

            <hr class="my-4">

            <div class="row mb-5">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h6 class="text-uppercase text-muted section-title">Dari:</h6>
                    <p class="mb-1">
                        <strong>{{ $transaction->room->boardingHouse->name }}</strong>
                    </p>
                    <p class="mb-1">{{ $transaction->room->boardingHouse->address }}</p>
                    <p class="mb-1">Email: {{ $transaction->room->boardingHouse->owner->email }}</p>

                    <p class="mb-0">Telp: {{ $transaction->room->boardingHouse->owner->identity->phone_number ?? "-" }}
                    </p>

                    <p class="mb-0">Whatsapp:
                        {{ $transaction->room->boardingHouse->owner->identity->whatsapp_number ?? "-" }}
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h6 class="text-uppercase text-muted section-title">Untuk:</h6>
                    <p class="mb-1">
                        <strong>{{ $transaction->user->name }}</strong>
                    </p>

                    <p class="mb-1">Alamat: {{ $transaction->user->identity->address }}</p>
                    <p class="mb-1">Email: {{ $transaction->user->email }}</p>

                    <p class="mb-0">Telp: {{ $transaction->user->identity->phone_number ?? "-" }}</p>
                    <p class="mb-0">Whatsapp: {{ $transaction->user->identity->whatsapp_number ?? "-" }}</p>

                </div>
            </div>

            <div class="card border-0 shadow-sm mb-5">
                <div class="card-header bg-primary text-white py-3 rounded-top">
                    <div class="row fw-bold">
                        <div class="col-6">DESKRIPSI ITEM</div>
                        <div class="col-3 text-end">PERIODE</div>
                        <div class="col-3 text-end">TOTAL</div>
                    </div>
                </div>
                <ul class="list-group list-group-flush border-bottom">
                    <li class="list-group-item py-3">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="fw-bold mb-0">{{ $transaction->room->boardingHouse->name }} - Kamar No.
                                    {{ $transaction->room->room_number }}</p>
                                <small class="text-muted">Periode Sewa:
                                    {{ \Carbon\Carbon::parse($transaction->check_in)->format("d M Y") }} s/d
                                    {{ \Carbon\Carbon::parse($transaction->check_out)->format("d M Y") }}</small>
                            </div>
                            <div class="col-3 text-end">
                                {{ \Carbon\Carbon::parse($transaction->check_in)->diffInMonths($transaction->check_out) }}
                                Bulan
                            </div>
                            <div class="col-3 text-end text-nowrap">
                                {{ formatRupiah($transaction->room->price) }}</div>

                        </div>
                    </li>

                </ul>
            </div>

            <div class="text-center mt-5 pt-4 border-top footer-info">
                <p class="lead fw-semibold mb-2 text-primary">Terima kasih!</p>
                <p class="text-muted mb-0">Status Pembayaran: <strong
                        class="text-success">{{ __("transaction_status." . $transaction->status) }}</strong>
                </p>
                <button class="btn btn-primary mt-4 px-4 py-2 rounded-pill d-print-none" onclick="window.print()">
                    <i class="fas fa-print me-2">
                    </i> Cetak Invoice
                </button>
            </div>
        </div>
    @endvolt
</x-guest-layout>
