<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\FonnteService;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.home');
    }

    public function notifyOwner(Transaction $transaction, FonnteService $fonnte)
    {
        $boardingHouse = $transaction->boardingHouse;
        $owner = $boardingHouse->owner;

        $phone = $owner->identity->whatsapp_number ?? $owner->identity->phone_number;

        $message = "🔔 Transaksi Baru dari {$transaction->user->name}!\n\n".
            "🏠 Kos: {$boardingHouse->name}\n".
            "📅 Tanggal Masuk: {$transaction->check_in}\n".
            "📆 Tanggal Keluar: {$transaction->check_out}\n".
            '💰 Total: Rp '.number_format($transaction->total, 0, ',', '.')."\n".
            "🧾 Kode Transaksi: {$transaction->code}";

        try {
            $result = $fonnte->sendMessage($phone, $message);
            Log::info('Notifikasi Fonnte berhasil dikirim.', $result);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim notifikasi Fonnte.', ['error' => $e->getMessage()]);
        }

        return back()->with('success', 'Notifikasi berhasil dikirim ke pemilik kos.');
    }
}
