@extends('admin.layout')

@section('title', 'Edit Service')

@section('content')
    <h1 class="h3 mb-3">Edit Service #{{ $service->id }}</h1>

    @include('admin.services.partials.form', [
        'action' => route('admin.services.update', ['locale' => app()->getLocale(), 'service' => $service->id]),
        'method' => 'PUT',
        'service' => $service,
    ])
@endsection
