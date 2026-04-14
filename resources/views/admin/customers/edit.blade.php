@extends('admin.layout')

@section('title', 'Edit Customer')

@section('content')
    <h1 class="h3 mb-3">Edit Customer #{{ $customer->id }}</h1>

    <form method="POST" action="{{ route('admin.customers.update', ['locale' => app()->getLocale(), 'customer' => $customer->id]) }}" class="card border-0 shadow-sm">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $customer->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">WhatsApp Number</label>
                    <input type="text" class="form-control" name="whatsapp_number" value="{{ old('whatsapp_number', $customer->whatsapp_number) }}" required>
                    <small class="text-muted">Format: +9715XXXXXXXX</small>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('admin.customers.index', ['locale' => app()->getLocale()]) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection
