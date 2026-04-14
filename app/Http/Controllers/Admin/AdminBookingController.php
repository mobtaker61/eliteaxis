<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceBooking;
use App\Services\RoniBotService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminBookingController extends Controller
{
    public function index(string $locale): View
    {
        return view('admin.bookings.index', [
            'bookings' => ServiceBooking::query()
                ->with(['customer', 'service', 'services'])
                ->latest()
                ->paginate(20),
        ]);
    }

    public function edit(string $locale, ServiceBooking $serviceBooking): View
    {
        return view('admin.bookings.edit', [
            'booking' => $serviceBooking->load(['customer', 'service', 'services']),
            'statuses' => $this->statuses(),
            'services' => Service::query()->where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function update(Request $request, string $locale, ServiceBooking $serviceBooking, RoniBotService $roniBotService): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in($this->statuses())],
            'service_ids' => ['required', 'array', 'min:1'],
            'service_ids.*' => ['required', 'integer', 'exists:services,id'],
            'requested_date' => ['required', 'date'],
            'requested_time' => ['required', 'date_format:H:i'],
        ]);

        $originalStatus = $serviceBooking->status;
        $serviceBooking->update([
            'status' => $data['status'],
            'requested_date' => $data['requested_date'],
            'requested_time' => $data['requested_time'],
            'service_id' => $data['service_ids'][0] ?? $serviceBooking->service_id,
        ]);
        $serviceBooking->services()->sync($data['service_ids']);
        $serviceBooking->load(['customer', 'service', 'services']);

        $this->notifyCustomerForStatusChange($serviceBooking, $originalStatus, $roniBotService);

        return redirect()
            ->route('admin.bookings.index', ['locale' => $locale])
            ->with('success', 'Booking updated successfully.');
    }

    public function updateStatus(Request $request, string $locale, ServiceBooking $serviceBooking, RoniBotService $roniBotService): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['confirmed', 'cancelled'])],
        ]);

        $originalStatus = $serviceBooking->status;
        $serviceBooking->update(['status' => $data['status']]);

        $this->notifyCustomerForStatusChange($serviceBooking, $originalStatus, $roniBotService);

        return back()->with('success', 'Booking status updated successfully.');
    }

    private function statuses(): array
    {
        return ['pending', 'confirmed', 'completed', 'cancelled'];
    }

    private function buildStatusMessage(ServiceBooking $booking): string
    {
        $service = $booking->services->pluck('name')
            ->map(fn ($value) => is_array($value) ? ($value[$booking->locale] ?? $value['en'] ?? null) : null)
            ->filter()
            ->implode(', ');
        if (! $service) {
            $service = $booking->service?->translate('name', $booking->locale) ?? '';
        }
        $date = $booking->requested_date?->format('Y-m-d') ?? '';
        $time = date('H:i', strtotime((string) $booking->requested_time));

        if ($booking->locale === 'ar') {
            $statusText = match ($booking->status) {
                'confirmed' => 'تم التأكيد',
                'completed' => 'تم الإنجاز',
                'cancelled' => 'تم الإلغاء',
                default => 'قيد المراجعة',
            };

            return "تحديث حالة الحجز #{$booking->id}\nالحالة: {$statusText}\nالخدمة: {$service}\nالموعد: {$date} {$time}";
        }

        $statusText = match ($booking->status) {
            'confirmed' => 'Confirmed',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            default => 'Pending',
        };

        return "Booking #{$booking->id} status updated.\nStatus: {$statusText}\nService: {$service}\nSchedule: {$date} {$time}";
    }

    private function notifyCustomerForStatusChange(ServiceBooking $serviceBooking, string $originalStatus, RoniBotService $roniBotService): void
    {
        if ($originalStatus === $serviceBooking->status) {
            return;
        }

        try {
            $customerWhatsapp = $serviceBooking->customer?->whatsapp_number;
            if (! $customerWhatsapp) {
                throw new \RuntimeException('Customer WhatsApp number is missing.');
            }

            $message = $this->buildStatusMessage($serviceBooking);
            $roniBotService->sendWhatsApp(
                $customerWhatsapp,
                $message
            );
        } catch (\Throwable $exception) {
            Log::error('Failed to send booking status update on WhatsApp.', [
                'booking_id' => $serviceBooking->id,
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
