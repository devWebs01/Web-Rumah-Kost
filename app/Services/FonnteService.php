<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    protected string $baseUrl = 'https://api.fonnte.com/send';
    protected string $token;

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
    }

    public function sendMessage(string $phone, string $message, string $countryCode = '62'): array
    {
        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->asForm()->post($this->baseUrl, [
                    'target' => $phone,
                    'message' => $message,
                    'countryCode' => $countryCode,
                ]);

        return $response->json();
    }
}
