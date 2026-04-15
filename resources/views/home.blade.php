@extends('layouts.main')

@section('title', __('site.title'))
@section('nav_home', 'active')

@section('content')
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('carserv/img/carousel-bg-1.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">{{ __('site.hero_tag_1') }}</h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">{{ __('site.hero_title_1') }}</h1>
                                    <a href="#services" class="btn btn-primary py-3 px-5 animated slideInDown">{{ __('site.hero_cta_1') }}<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="{{ asset('carserv/img/carousel-1.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('carserv/img/carousel-bg-2.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">{{ __('site.hero_tag_2') }}</h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">{{ __('site.hero_title_2') }}</h1>
                                    <a href="#contact" class="btn btn-primary py-3 px-5 animated slideInDown">{{ __('site.hero_cta_2') }}<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="{{ asset('carserv/img/carousel-2.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div id="about" class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 pt-4" style="min-height: 400px;">
                    <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('carserv/img/about.jpg') }}" style="object-fit: cover;" alt="">
                        <div class="position-absolute top-0 end-0 mt-n4 me-n4 py-4 px-5" style="background: rgba(0, 0, 0, .08);">
                            <h1 class="display-4 text-white mb-0">{{ __('site.experience_years') }} <span class="fs-4">{{ __('site.experience_label') }}</span></h1>
                            <h4 class="text-white">{{ __('site.experience_caption') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h6 class="text-primary text-uppercase">{{ __('site.about_tag') }}</h6>
                    <h1 class="mb-4">{!! __('site.about_title', ['brand' => '<span class="text-primary">'.__('site.brand').'</span>']) !!}</h1>
                    <p class="mb-4">{{ __('site.about_text') }}</p>
                    <div class="row g-4 mb-3 pb-3">
                        <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">01</span>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ __('site.about_feature_1_title') }}</h6>
                                    <span>{{ __('site.about_feature_1_text') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">02</span>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ __('site.about_feature_2_title') }}</h6>
                                    <span>{{ __('site.about_feature_2_text') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">03</span>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ __('site.about_feature_3_title') }}</h6>
                                    <span>{{ __('site.about_feature_3_text') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#contact" class="btn btn-primary py-3 px-5">{{ __('site.about_cta') }}<i class="fa fa-arrow-right ms-3"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div id="services" class="container-xxl service py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">{{ __('site.services_tag') }}</h6>
                <h1 class="mb-5">{{ __('site.services_title') }}</h1>
            </div>
            <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-4"> <!-- services navigation -->
                    <ul class="nav nav-pills row g-3 w-100 me-lg-4 list-unstyled mb-0">
                        @forelse ($services as $service)
                            <li class="col-4 nav-item">
                                <button class="nav-link w-100 h-100 d-flex flex-column align-items-center justify-content-center text-center p-3 {{ $loop->first ? 'active' : '' }}"
                                    data-bs-toggle="pill"
                                    data-bs-target="#tab-pane-{{ $service->id }}"
                                    type="button">
                                    <i class="{{ $service->icon ?? 'fa fa-cog' }} fa-2x mb-2"></i>
                                    <h6 class="m-0">{{ $service->translate('name') }}</h6>
                                </button>
                            </li>
                        @empty
                            <li class="col-12">
                                <div class="bg-light p-4">
                                    <p class="mb-0">{{ __('site.no_services') }}</p>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
                <div class="col-lg-8"> <!-- services content -->
                    <div class="tab-content w-100">
                        @forelse ($services as $service)
                            @php
                                $features = $service->translate('features');
                            @endphp
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-pane-{{ $service->id }}">
                                <div class="row g-4">
                                    <div class="col-md-6" style="min-height: 350px;">
                                        <div class="position-relative h-100">
                                            <img class="position-absolute img-fluid w-100 h-100" src="{{ asset($service->image) }}" style="object-fit: cover;" alt="{{ $service->translate('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3">{{ $service->translate('title') }}</h3>
                                        <p class="mb-4">{{ $service->translate('description') }}</p>
                                        @if (is_array($features))
                                            @foreach ($features as $feature)
                                                <p><i class="fa fa-check text-success me-3"></i>{{ $feature }}</p>
                                            @endforeach
                                        @endif
                                        <a href="#contact" class="btn btn-primary py-3 px-5 mt-3">{{ __('site.about_cta') }}<i class="fa fa-arrow-right ms-3"></i></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="tab-pane fade show active">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="bg-light p-4">
                                            <p class="mb-0">{{ __('site.no_services') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="reservation" class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">{{ __('site.reservation_tag') }}</h6>
                <h1 class="mb-5">{{ __('site.reservation_title') }}</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-4 wow fadeIn" data-wow-delay="0.1s">
                    <picture>
                        <source media="(max-width: 991.98px)" srcset="{{ asset('carserv/img/reservation-mobile.jpg') }}">
                        <img class="img-fluid rounded w-100 h-100" src="{{ asset('carserv/img/reservation.jpg') }}" style="object-fit: cover; min-height: 50px;" alt="Reservation">
                    </picture>
                </div>
                <div class="col-md-8">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <h4 class="mb-4">{{ __('site.booking_intro') }}</h4>

                        @if (session('booking_success'))
                            <div class="alert alert-success">{{ session('booking_success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST"
                            action="{{ route('book-service.store', ['locale' => app()->getLocale()]) }}"
                            data-customer-lookup-url="{{ route('book-service.lookup', ['locale' => app()->getLocale()]) }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text">+971</span>
                                        <div class="form-floating flex-grow-1">
                                            <input type="text"
                                                class="form-control"
                                                id="whatsapp_number"
                                                name="whatsapp_number"
                                                value="{{ ltrim((string) preg_replace('/^\+971/', '', (string) old('whatsapp_number')), '0') }}"
                                                placeholder="{{ __('site.booking_whatsapp_placeholder') }}"
                                                inputmode="numeric"
                                                pattern="5[0-9]{8}">
                                            <label for="whatsapp_number">{{ __('site.booking_whatsapp') }}</label>
                                        </div>
                                    </div>
                                    <div id="whatsapp-preview" class="small fw-semibold text-primary mt-1 d-none"></div>
                                    <div id="customer-lookup-message" class="small mt-1"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('site.booking_name') }}">
                                        <label for="name">{{ __('site.booking_name') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <select class="form-select" id="car_make" name="car_make">
                                            <option value="" selected disabled>{{ __('site.booking_make_placeholder') }}</option>
                                            @foreach ($carMakes as $make)
                                                <option value="{{ $make }}" @selected(old('car_make') === $make)>{{ $make }}</option>
                                            @endforeach
                                        </select>
                                        <label for="car_make">{{ __('site.booking_make') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="car_model" name="car_model" value="{{ old('car_model') }}" placeholder="{{ __('site.booking_model') }}">
                                        <label for="car_model">{{ __('site.booking_model') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="car_year" name="car_year" value="{{ old('car_year') }}" placeholder="{{ __('site.booking_year') }}" min="1980" max="{{ date('Y') + 1 }}">
                                        <label for="car_year">{{ __('site.booking_year') }}</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label d-block">{{ __('site.booking_service_type') }}</label>
                                    <div class="booking-services-selector border rounded p-3 bg-white">
                                        @foreach ($services as $service)
                                            <div class="booking-service-card-item">
                                                <input class="booking-service-card-input"
                                                    type="checkbox"
                                                    id="service_{{ $service->id }}"
                                                    name="service_ids[]"
                                                    value="{{ $service->id }}"
                                                    @checked(in_array($service->id, array_map('intval', old('service_ids', [])), true))>
                                                <label class="booking-service-card-label" for="service_{{ $service->id }}">
                                                    <span class="booking-service-card-avatar-wrap">
                                                        @if ($service->avatar)
                                                            <img class="booking-service-card-avatar"
                                                                src="{{ asset($service->avatar) }}"
                                                                alt="{{ $service->translate('name') }}">
                                                        @else
                                                            <span class="booking-service-card-fallback-icon">
                                                                <i class="{{ $service->icon ?? 'fa fa-cog' }}"></i>
                                                            </span>
                                                        @endif
                                                    </span>
                                                    <span class="booking-service-card-title">{{ $service->translate('name') }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="requested_date" name="requested_date" value="{{ old('requested_date') }}" min="{{ now()->toDateString() }}">
                                        <label for="requested_date">{{ __('site.booking_requested_date') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="time" class="form-control" id="requested_time" name="requested_time" value="{{ old('requested_time') }}">
                                        <label for="requested_time">{{ __('site.booking_requested_time') }}</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">{{ __('site.booking_submit') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="blog" class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">{{ __('site.blog_tag') }}</h6>
                <h1 class="mb-5">{{ __('site.blog_title') }}</h1>
            </div>
            <div class="row g-4">
                <div class="col-12">
                    <div class="row gy-4">
                        <div class="col-md-4">
                            <div class="bg-light d-flex flex-column justify-content-center p-4">
                                <h5 class="text-uppercase">{{ __('site.contact_booking') }}</h5>
                                <p class="m-0"><i class="fa fa-envelope-open text-primary me-2"></i>{{ __('site.contact_booking_email') }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-light d-flex flex-column justify-content-center p-4">
                                <h5 class="text-uppercase">{{ __('site.contact_general') }}</h5>
                                <p class="m-0"><i class="fa fa-envelope-open text-primary me-2"></i>{{ __('site.contact_general_email') }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-light d-flex flex-column justify-content-center p-4">
                                <h5 class="text-uppercase">{{ __('site.contact_technical') }}</h5>
                                <p class="m-0"><i class="fa fa-envelope-open text-primary me-2"></i>{{ __('site.contact_technical_email') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        (function () {
            const input = document.getElementById('whatsapp_number');
            const preview = document.getElementById('whatsapp-preview');
            const form = input ? input.closest('form') : null;
            const lookupMessage = document.getElementById('customer-lookup-message');
            const lookupUrl = form ? form.dataset.customerLookupUrl : null;
            const nameInput = document.getElementById('name');
            const carMakeInput = document.getElementById('car_make');
            const carModelInput = document.getElementById('car_model');
            const carYearInput = document.getElementById('car_year');
            const serviceCheckboxes = Array.from(document.querySelectorAll('input[name="service_ids[]"]'));
            const previewLabel = @json(__('site.booking_whatsapp_preview_label'));
            const invalidMessage = @json(__('site.booking_whatsapp_invalid'));
            const customerFoundText = @json(__('site.booking_customer_found'));
            const customerNotFoundText = @json(__('site.booking_customer_not_found'));

            let lookupTimer = null;
            let lastLookupDigits = '';

            if (!input || !preview || !form) {
                return;
            }

            const setLookupMessage = (text, type) => {
                if (!lookupMessage) return;
                lookupMessage.textContent = text || '';
                lookupMessage.className = `small mt-1 ${type === 'success' ? 'text-success' : type === 'error' ? 'text-danger' : 'text-muted'}`;
            };

            const ensureCarMakeOption = (value) => {
                if (!carMakeInput || !value) return;
                const exists = Array.from(carMakeInput.options).some((option) => option.value === value);
                if (!exists) {
                    const option = document.createElement('option');
                    option.value = value;
                    option.textContent = value;
                    carMakeInput.appendChild(option);
                }
                carMakeInput.value = value;
            };

            const applyServices = (ids) => {
                if (!Array.isArray(ids)) return;
                const lookupSet = new Set(ids.map((id) => Number(id)));
                serviceCheckboxes.forEach((checkbox) => {
                    checkbox.checked = lookupSet.has(Number(checkbox.value));
                });
            };

            const runLookup = (digits) => {
                if (!lookupUrl || digits.length !== 9 || !/^5\d{8}$/.test(digits)) {
                    return;
                }
                if (lastLookupDigits === digits) {
                    return;
                }
                lastLookupDigits = digits;

                fetch(`${lookupUrl}?whatsapp_number=${encodeURIComponent(digits)}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                    .then(async (response) => {
                        const data = await response.json().catch(() => ({}));
                        if (!response.ok) {
                            throw new Error(data.message || 'lookup_failed');
                        }
                        return data;
                    })
                    .then((data) => {
                        if (!data.found) {
                            setLookupMessage(customerNotFoundText, 'neutral');
                            return;
                        }

                        if (nameInput && data.customer?.name) {
                            nameInput.value = data.customer.name;
                        }
                        if (carModelInput && data.vehicle?.car_model) {
                            carModelInput.value = data.vehicle.car_model;
                        }
                        if (carYearInput && data.vehicle?.car_year) {
                            carYearInput.value = data.vehicle.car_year;
                        }
                        ensureCarMakeOption(data.vehicle?.car_make);
                        applyServices(data.service_ids);
                        setLookupMessage(customerFoundText, 'success');
                    })
                    .catch(() => {
                        setLookupMessage(customerNotFoundText, 'error');
                    });
            };

            const render = () => {
                let digits = input.value.replace(/\D+/g, '');

                if (digits.startsWith('971')) {
                    digits = digits.slice(3);
                }
                if (digits.startsWith('0')) {
                    digits = digits.slice(1);
                }

                digits = digits.slice(0, 9);
                input.value = digits;

                const finalNumber = '+971' + digits;
                preview.textContent = digits.length ? `${previewLabel} ${finalNumber}` : '';
                preview.classList.toggle('d-none', !digits.length);

                const valid = /^5\d{8}$/.test(digits);
                if (digits.length > 0 && !valid) {
                    input.setCustomValidity(invalidMessage);
                } else {
                    input.setCustomValidity('');
                }

                if (lookupTimer) {
                    clearTimeout(lookupTimer);
                }
                if (valid) {
                    lookupTimer = setTimeout(() => runLookup(digits), 350);
                } else {
                    setLookupMessage('', 'neutral');
                    lastLookupDigits = '';
                }
            };

            input.addEventListener('input', render);
            form.addEventListener('submit', render);
            render();
        })();
    </script>
@endsection
