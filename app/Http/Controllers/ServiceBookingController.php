<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceBookingRequest;
use App\Jobs\DispatchServiceBookingNotifications;
use App\Models\Customer;
use App\Models\ServiceBooking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceBookingController extends Controller
{
    public function lookupCustomer(Request $request, string $locale): JsonResponse
    {
        $request->validate([
            'whatsapp_number' => ['required', 'string', 'max:30'],
        ]);

        $normalizedWhatsapp = $this->normalizeUaeWhatsapp((string) $request->input('whatsapp_number'));
        if (! preg_match('/^\+9715\d{8}$/', $normalizedWhatsapp)) {
            return response()->json([
                'found' => false,
                'message' => __('site.booking_whatsapp_invalid'),
            ], 422);
        }

        $customer = Customer::query()
            ->where('whatsapp_number', $normalizedWhatsapp)
            ->first();

        if (! $customer) {
            return response()->json([
                'found' => false,
            ]);
        }

        $latestBooking = $customer->serviceBookings()
            ->with(['service', 'services'])
            ->orderByDesc('requested_date')
            ->orderByDesc('requested_time')
            ->orderByDesc('id')
            ->first();

        $serviceIds = $latestBooking?->services->pluck('id')->values()->all() ?? [];
        if (empty($serviceIds) && $latestBooking?->service_id) {
            $serviceIds = [$latestBooking->service_id];
        }

        return response()->json([
            'found' => true,
            'customer' => [
                'name' => $customer->name,
                'whatsapp_number' => $customer->whatsapp_number,
            ],
            'vehicle' => [
                'car_make' => $latestBooking?->car_make,
                'car_model' => $latestBooking?->car_model,
                'car_year' => $latestBooking?->car_year,
            ],
            'service_ids' => $serviceIds,
        ]);
    }

    public function __invoke(StoreServiceBookingRequest $request, string $locale): RedirectResponse|JsonResponse
    {
        $data = $request->validated();

        $booking = DB::transaction(function () use ($data, $locale) {
            $customer = Customer::query()->updateOrCreate(
                ['whatsapp_number' => $data['whatsapp_number']],
                ['name' => $data['name']]
            );

            $booking = ServiceBooking::query()->create([
                'customer_id' => $customer->id,
                'service_id' => $data['service_ids'][0] ?? null,
                'car_make' => $data['car_make'],
                'car_model' => $data['car_model'],
                'car_year' => $data['car_year'],
                'requested_date' => $data['requested_date'],
                'requested_time' => $data['requested_time'],
                'status' => 'pending',
                'locale' => $locale,
            ]);

            $booking->services()->sync($data['service_ids']);

            return $booking;
        });

        try {
            if (config('booking.queue_notifications', false)) {
                DispatchServiceBookingNotifications::dispatch($booking->id);
            } else {
                DispatchServiceBookingNotifications::dispatchSync($booking->id);
            }
        } catch (\Throwable $exception) {
            Log::error('Booking notifications dispatch failed.', [
                'booking_id' => $booking->id,
                'error' => $exception->getMessage(),
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => __('site.booking_success'),
            ]);
        }

        return redirect()
            ->to(route('home', ['locale' => $locale]).'#reservation')
            ->with('booking_success', __('site.booking_success'));
    }

    private function normalizeUaeWhatsapp(string $rawWhatsapp): string
    {
        $digits = preg_replace('/\D+/', '', $rawWhatsapp) ?? '';

        if (str_starts_with($digits, '971')) {
            $digits = substr($digits, 3);
        } elseif (str_starts_with($digits, '0')) {
            $digits = substr($digits, 1);
        }

        return '+971'.$digits;
    }
}
