<?php

namespace App\Http\Middleware;

use App\Mail\TransactionCancelledMail;
use App\Models\Transaction;
use App\Services\FonnteService;
use Closure;
use Illuminate\Support\Facades\Mail;

class AutoCancelTransactions
{
    public function handle($request, Closure $next)
    {
        //  Aktifkan jika ingin sekali sehari melakukan pengecekan data booking, jika disable maka setiap saat
        // if (cache()->has('auto_cancel_ran_today')) {
        //     return $next($request);
        // }
        // cache()->put('auto_cancel_ran_today', true, now()->endOfDay());

        // Ambil transaksi yang belum dikonfirmasi dan sudah melewati batas waktu
        $expiredTransactions = Transaction::with([
            'user.identity',
            'room.boardingHouse.owner.identity',
        ])
            ->where('status', 'pending')
            ->where('created_at', '<', now()->subHours(24))
            ->get();

        // app/Http/Middleware/AutoCancelTransactions.php

        // … kode sebelumnya …

        foreach ($expiredTransactions as $transaction) {
            // 1. Batalkan status transaksi
            $transaction->update(['status' => 'cancelled']);

            // 2. Kembalikan kamar ke status 'available'
            if ($room = $transaction->room) {
                $room->update(['status' => 'available']);
            }

            // 3. Siapkan data tenant dan owner
            $tenant = $transaction->user;
            $owner = $room->boardingHouse->owner ?? null;

            // 4. Susun pesan WA
            $message = implode("\n", [
                'Halo!',
                "Transaksi dengan kode *{$transaction->code}* telah dibatalkan otomatis karena tidak dikonfirmasi dalam 24 jam.",
                "Nama Penyewa: {$tenant->name}",
                "Email Penyewa: {$tenant->email}",
                '',
                'Terima kasih.',
            ]);

            // 5. Closure untuk kirim notifikasi (WA → email fallback)
            $notify = function ($to) use ($message, $transaction) {
                try {
                    (new FonnteService)->send($to, $message);
                } catch (\Throwable $e) {
                    if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
                        Mail::to($to)->send(new TransactionCancelledMail($transaction));
                    }
                }
            };

            // 6. Kirim ke pemilik
            if ($owner && $owner->identity && $owner->identity->whatsapp_number) {
                $notify($owner->identity->whatsapp_number);
            }

            // 7. Kirim ke penyewa
            if ($tenant->identity && $tenant->identity->whatsapp_number) {
                $notify($tenant->identity->whatsapp_number);
            }
        }

        return $next($request);
    }
}
