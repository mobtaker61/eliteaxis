<form method="POST" action="{{ $action }}" class="card border-0 shadow-sm" enctype="multipart/form-data">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Name (EN)</label>
                <input type="text" class="form-control" name="name_en" value="{{ old('name_en', $service?->translate('name', 'en')) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Name (AR)</label>
                <input type="text" class="form-control" name="name_ar" value="{{ old('name_ar', $service?->translate('name', 'ar')) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Title (EN)</label>
                <input type="text" class="form-control" name="title_en" value="{{ old('title_en', $service?->translate('title', 'en')) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Title (AR)</label>
                <input type="text" class="form-control" name="title_ar" value="{{ old('title_ar', $service?->translate('title', 'ar')) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Description (EN)</label>
                <textarea class="form-control" name="description_en" rows="4" required>{{ old('description_en', $service?->translate('description', 'en')) }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Description (AR)</label>
                <textarea class="form-control" name="description_ar" rows="4" required>{{ old('description_ar', $service?->translate('description', 'ar')) }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Content (EN - HTML allowed)</label>
                <textarea class="form-control" name="content_en" rows="5">{{ old('content_en', $service?->translate('content', 'en')) }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Content (AR - HTML allowed)</label>
                <textarea class="form-control" name="content_ar" rows="5">{{ old('content_ar', $service?->translate('content', 'ar')) }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Features (EN) - one per line</label>
                <textarea class="form-control" name="features_en" rows="4">{{ old('features_en', is_array($service?->translate('features', 'en')) ? implode("\n", $service->translate('features', 'en')) : '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Features (AR) - one per line</label>
                <textarea class="form-control" name="features_ar" rows="4">{{ old('features_ar', is_array($service?->translate('features', 'ar')) ? implode("\n", $service->translate('features', 'ar')) : '') }}</textarea>
            </div>

            <div class="col-md-4">
                <label class="form-label">Icon (Font Awesome class)</label>
                <input type="text" class="form-control" name="icon" value="{{ old('icon', $service->icon ?? 'fa fa-cog') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Service Image Upload</label>
                <input type="file" class="form-control" name="image_file" accept=".jpg,.jpeg,.png,.webp" {{ $service ? '' : 'required' }}>
                @if ($service?->image)
                    <img src="{{ asset($service->image) }}" alt="Service Image" class="img-thumbnail mt-2" style="height: 70px;">
                @endif
            </div>
            <div class="col-md-2">
                <label class="form-label">Avatar Upload</label>
                <input type="file" class="form-control" name="avatar_file" accept=".jpg,.jpeg,.png,.webp">
                @if ($service?->avatar)
                    <img src="{{ asset($service->avatar) }}" alt="Service Avatar" class="img-thumbnail mt-2" style="height: 70px;">
                @endif
            </div>
            <div class="col-md-2">
                <label class="form-label">Sort Order</label>
                <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 1) }}" min="0" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                        @checked(old('is_active', $service->is_active ?? true))>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer bg-white d-flex gap-2">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.services.index', ['locale' => app()->getLocale()]) }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</form>
