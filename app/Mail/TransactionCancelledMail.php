<?php

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function build()
    {
        return $this->subject('Transaksi Dibatalkan')
            ->view('emails.transaction-cancelled');
    }
}
