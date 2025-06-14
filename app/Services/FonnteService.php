<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    protected $token;

    public function __construct()
    {
        $this->token = env('FONNTE_TOKEN'); // Simpan token di config
    }

    public function send($target, $message)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => $this->sanitizePhone($target),
            'message' => $message,
            'countryCode' => '62', // Opsional
        ]);

        return $response->json();
    }

    protected function sanitizePhone($phone)
    {
        // Ubah 08xxx jadi 628xxx
        return preg_replace('/^0/', '62', $phone);
    }
}
