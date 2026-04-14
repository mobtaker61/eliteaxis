<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminServiceController extends Controller
{
    public function index(string $locale): View
    {
        return view('admin.services.index', [
            'services' => Service::query()->orderBy('sort_order')->paginate(15),
        ]);
    }

    public function create(string $locale): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request, string $locale): RedirectResponse
    {
        $data = $this->validated($request, null, true);
        $data['slug'] = Str::slug($data['name']['en']);

        Service::query()->create($data);

        return redirect()
            ->route('admin.services.index', ['locale' => $locale])
            ->with('success', 'Service created successfully.');
    }

    public function edit(string $locale, Service $service): View
    {
        return view('admin.services.edit', [
            'service' => $service,
        ]);
    }

    public function update(Request $request, string $locale, Service $service): RedirectResponse
    {
        $data = $this->validated($request, $service, false);
        $data['slug'] = Str::slug($data['name']['en']);

        $service->update($data);

        return redirect()
            ->route('admin.services.index', ['locale' => $locale])
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(string $locale, Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()
            ->route('admin.services.index', ['locale' => $locale])
            ->with('success', 'Service deleted successfully.');
    }

    private function validated(Request $request, ?Service $service = null, bool $isCreate = false): array
    {
        $maxSort = (Service::query()->max('sort_order') ?? 0) + 1000;

        $data = $request->validate([
            'name_en' => ['required', 'string', 'max:120'],
            'name_ar' => ['required', 'string', 'max:120'],
            'title_en' => ['required', 'string', 'max:160'],
            'title_ar' => ['required', 'string', 'max:160'],
            'description_en' => ['required', 'string'],
            'description_ar' => ['required', 'string'],
            'content_en' => ['nullable', 'string'],
            'content_ar' => ['nullable', 'string'],
            'features_en' => ['nullable', 'string'],
            'features_ar' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:80'],
            'image_file' => [$isCreate ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'avatar_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order' => ['required', 'integer', 'between:0,'.$maxSort],
            'is_active' => ['nullable', 'in:1'],
        ]);

        $imagePath = $service->image ?? null;
        if ($request->hasFile('image_file')) {
            if ($service?->image && str_starts_with($service->image, 'storage/')) {
                Storage::disk('public')->delete(Str::after($service->image, 'storage/'));
            }
            $storedPath = $request->file('image_file')->store('services/images', 'public');
            $imagePath = 'storage/'.$storedPath;
        }

        $avatarPath = $service->avatar ?? null;
        if ($request->hasFile('avatar_file')) {
            if ($service?->avatar && str_starts_with($service->avatar, 'storage/')) {
                Storage::disk('public')->delete(Str::after($service->avatar, 'storage/'));
            }
            $storedAvatarPath = $request->file('avatar_file')->store('services/avatars', 'public');
            $avatarPath = 'storage/'.$storedAvatarPath;
        }

        return [
            'name' => [
                'en' => $data['name_en'],
                'ar' => $data['name_ar'],
            ],
            'title' => [
                'en' => $data['title_en'],
                'ar' => $data['title_ar'],
            ],
            'description' => [
                'en' => $data['description_en'],
                'ar' => $data['description_ar'],
            ],
            'content' => [
                'en' => $data['content_en'] ?? null,
                'ar' => $data['content_ar'] ?? null,
            ],
            'features' => [
                'en' => $this->linesToArray($data['features_en'] ?? ''),
                'ar' => $this->linesToArray($data['features_ar'] ?? ''),
            ],
            'icon' => $data['icon'] ?: 'fa fa-cog',
            'image' => $imagePath ?: 'carserv/img/service-1.jpg',
            'avatar' => $avatarPath,
            'sort_order' => $data['sort_order'],
            'is_active' => isset($data['is_active']),
        ];
    }

    private function linesToArray(string $text): array
    {
        return array_values(array_filter(array_map(
            static fn (string $line): string => trim($line),
            preg_split('/\r\n|\r|\n/', $text) ?: []
        )));
    }
}
