<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServiceBookingRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $rawWhatsapp = (string) $this->input('whatsapp_number', '');

        // Keep digits only, then normalize to UAE format +9715XXXXXXXX
        $digits = preg_replace('/\D+/', '', $rawWhatsapp) ?? '';

        if (str_starts_with($digits, '971')) {
            $digits = substr($digits, 3);
        } elseif (str_starts_with($digits, '0')) {
            $digits = substr($digits, 1);
        }

        $normalized = '+971'.$digits;

        $this->merge([
            'whatsapp_number' => $normalized,
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $maxYear = (int) date('Y') + 1;

        return [
            'whatsapp_number' => ['required', 'regex:/^\+9715\d{8}$/'],
            'name' => ['required', 'string', 'max:120'],
            'car_make' => ['required', 'string', Rule::in(config('booking.car_makes', []))],
            'car_model' => ['required', 'string', 'max:120'],
            'car_year' => ['required', 'integer', 'between:1980,'.$maxYear],
            'service_ids' => ['required', 'array', 'min:1'],
            'service_ids.*' => ['required', 'integer', 'exists:services,id'],
            'requested_date' => ['required', 'date', 'after_or_equal:today'],
            'requested_time' => [
                'required',
                'date_format:H:i',
                static function (string $attribute, mixed $value, \Closure $fail): void {
                    if (! is_string($value) || ! preg_match('/^\d{2}:\d{2}$/', $value)) {
                        return;
                    }

                    [$hours, $minutes] = array_map('intval', explode(':', $value));
                    $totalMinutes = ($hours * 60) + $minutes;
                    $startMinutes = 10 * 60; // 10:00
                    $endMinutes = 17 * 60;   // 17:00

                    if ($totalMinutes < $startMinutes || $totalMinutes > $endMinutes) {
                        $fail(__('site.booking_time_range_error'));
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'whatsapp_number.regex' => __('site.booking_whatsapp_invalid'),
        ];
    }
}
