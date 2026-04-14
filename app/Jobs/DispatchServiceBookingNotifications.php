<?php

namespace App\Jobs;

use App\Mail\ServiceBookingCreatedMail;
use App\Models\ServiceBooking;
use App\Services\RoniBotService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class DispatchServiceBookingNotifications implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public int $bookingId
    ) {
    }

    public function handle(RoniBotService $roniBotService): void
    {
        $booking = ServiceBooking::query()
            ->with(['customer', 'service', 'services'])
            ->find($this->bookingId);

        if (! $booking) {
            return;
        }

        $adminEmails = config('booking.admin_emails', []);
        if (! empty($adminEmails)) {
            Mail::to($adminEmails)->send(new ServiceBookingCreatedMail($booking));
        }

        $customerMessage = $this->buildCustomerMessage($booking);
        $roniBotService->sendWhatsApp($booking->customer->whatsapp_number, $customerMessage);

        $adminMessage = $this->buildAdminMessage($booking);
        foreach (config('booking.admin_whatsapps', []) as $adminWhatsapp) {
            $roniBotService->sendWhatsApp($adminWhatsapp, $adminMessage);
        }
    }

    private function buildCustomerMessage(ServiceBooking $booking): string
    {
        $date = $booking->requested_date?->format('Y-m-d') ?? '';
        $time = date('H:i', strtotime((string) $booking->requested_time));
        $serviceName = $booking->services->map(fn ($service) => $service->translate('name', $booking->locale))
            ->filter()
            ->implode(', ');
        if (! $serviceName) {
            $serviceName = $booking->service?->translate('name', $booking->locale) ?? '';
        }

        if ($booking->locale === 'ar') {
            return "شكرا {$booking->customer->name}.\nتم استلام طلب الحجز بنجاح.\nالخدمة: {$serviceName}\nالتاريخ: {$date}\nالوقت: {$time}\nسيتم التواصل معك قريبا.";
        }

        return "Thank you {$booking->customer->name}.\nYour booking request has been received.\nService: {$serviceName}\nDate: {$date}\nTime: {$time}\nOur team will contact you soon.";
    }

    private function buildAdminMessage(ServiceBooking $booking): string
    {
        $date = $booking->requested_date?->format('Y-m-d') ?? '';
        $time = date('H:i', strtotime((string) $booking->requested_time));
        $serviceName = $booking->services->map(fn ($service) => $service->translate('name', 'en'))
            ->filter()
            ->implode(', ');
        if (! $serviceName) {
            $serviceName = $booking->service?->translate('name', 'en') ?? '';
        }

        return "New booking #{$booking->id}\nCustomer: {$booking->customer->name}\nWhatsApp: {$booking->customer->whatsapp_number}\nVehicle: {$booking->car_make} {$booking->car_model} ({$booking->car_year})\nService: {$serviceName}\nRequested: {$date} {$time}";
    }
}
