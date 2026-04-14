<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RoniBotService
{
    public function sendWhatsApp(string $to, string $message): bool
    {
        $endpoint = config('services.ronibot.endpoint');
        $appKey = config('services.ronibot.appkey');
        $authKey = config('services.ronibot.authkey');
        $sandboxConfig = config('services.ronibot.sandbox');
        $timeout = (int) config('services.ronibot.timeout', 10);
        $normalizedTo = $this->normalizeRecipientNumber($to);

        if (! $endpoint || ! $appKey || ! $authKey) {
            Log::warning('RoniBot credentials are missing. WhatsApp notification skipped.', [
                'to' => $to,
            ]);

            return false;
        }

        $payload = [
            'appkey' => $appKey,
            'authkey' => $authKey,
            'to' => $normalizedTo,
            'message' => $message,
        ];

        if ($sandboxConfig !== null && $sandboxConfig !== '') {
            $payload['sandbox'] = filter_var($sandboxConfig, FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false';
        }

        Log::info('Sending WhatsApp message through RoniBot.', [
            'to' => $normalizedTo,
            'endpoint' => $endpoint,
        ]);

        $response = Http::timeout($timeout)
            ->asMultipart()
            ->post($endpoint, $payload);

        if (! $response->successful()) {
            Log::error('RoniBot WhatsApp API call failed.', [
                'to' => $normalizedTo,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return false;
        }

        $json = $response->json();
        if (($json['message_status'] ?? null) !== 'Success') {
            Log::error('RoniBot responded without success status.', [
                'to' => $normalizedTo,
                'response' => $json,
            ]);

            return false;
        }

        Log::info('RoniBot WhatsApp message sent successfully.', [
            'to' => $normalizedTo,
            'response' => $json,
        ]);

        return true;
    }

    private function normalizeRecipientNumber(string $number): string
    {
        return preg_replace('/\D+/', '', $number) ?? '';
    }
}
