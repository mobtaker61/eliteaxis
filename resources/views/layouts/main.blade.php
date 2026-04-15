<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <title>@yield('title', __('site.title'))</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{ __('site.meta_keywords') }}" name="keywords">
    <meta content="{{ __('site.meta_description') }}" name="description">

    <link href="{{ asset('img/eliteaxis_icon.png') }}" rel="icon" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.3.2/css/flag-icons.min.css" rel="stylesheet">

    <link href="{{ asset('carserv/lib/animate/animate.min.css') }}" rel="stylesheet">
    @if (app()->getLocale() === 'ar')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="{{ asset('carserv/css/bootstrap.min.css') }}" rel="stylesheet">
    @endif
    <link href="{{ asset('carserv/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('carserv/css/custom.css') }}" rel="stylesheet">
</head>

<body>
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>{{ __('site.topbar_address') }}</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>{{ __('site.topbar_hours') }}</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fab fa-whatsapp text-primary me-2"></small>
                    <small><a class="text-reset" href="{{ __('site.topbar_whatsapp_link') }}">{{ __('site.topbar_whatsapp') }}</a></small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square bg-white text-primary me-0" href="https://www.instagram.com/elite_axis.ae/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        @php
            $currentLocale = app()->getLocale();
            $currentFlagCode = $currentLocale === 'ar' ? 'ae' : 'us';
        @endphp
        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="{{ asset('img/Elite_axis_logo.png') }}" alt="{{ __('site.brand') }}" class="brand-logo">
        </a>
        <div class="d-flex align-items-center ms-auto pe-4 d-lg-none">
            <div class="dropdown lang-switcher-dropdown me-2">
                <button class="btn btn-sm btn-link nav-link dropdown-toggle lang-switcher-toggle" type="button" id="mobileLanguageSwitcher" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="fi fi-{{ $currentFlagCode }} lang-flag-icon" aria-hidden="true"></span>                  
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="mobileLanguageSwitcher">
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 lang-switcher-link {{ $currentLocale === 'en' ? 'active' : '' }}"
                            href="{{ route('home', ['locale' => 'en']) }}"
                            data-base-url="{{ route('home', ['locale' => 'en']) }}">
                            <span class="fi fi-us lang-flag-icon" aria-hidden="true"></span>
                            <span>{{ __('site.language_en') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 lang-switcher-link {{ $currentLocale === 'ar' ? 'active' : '' }}"
                            href="{{ route('home', ['locale' => 'ar']) }}"
                            data-base-url="{{ route('home', ['locale' => 'ar']) }}">
                            <span class="fi fi-ae lang-flag-icon" aria-hidden="true"></span>
                            <span>{{ __('site.language_ar') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <button type="button" class="navbar-toggler d-none" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-hidden="true" tabindex="-1">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="#reservation" class="btn btn-primary btn-sm py-2 px-3 book-service-btn">{{ __('site.nav_book') }}</a>
        </div>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="#services" class="nav-item nav-link">{{ __('site.nav_services') }}</a>
                <a href="#blog" class="nav-item nav-link">{{ __('site.nav_blog') }}</a>
                <a href="#about" class="nav-item nav-link">{{ __('site.nav_about') }}</a>
                <a href="#contact" class="nav-item nav-link">{{ __('site.nav_contact') }}</a>
                <div class="nav-item dropdown lang-switcher-dropdown d-none d-lg-block">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center lang-switcher-toggle" id="desktopLanguageSwitcher" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fi fi-{{ $currentFlagCode }} lang-flag-icon" aria-hidden="true"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm m-0" aria-labelledby="desktopLanguageSwitcher">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 lang-switcher-link {{ $currentLocale === 'en' ? 'active' : '' }}"
                                href="{{ route('home', ['locale' => 'en']) }}"
                                data-base-url="{{ route('home', ['locale' => 'en']) }}">
                                <span class="fi fi-us lang-flag-icon" aria-hidden="true"></span>
                                <span>{{ __('site.language_en') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 lang-switcher-link {{ $currentLocale === 'ar' ? 'active' : '' }}"
                                href="{{ route('home', ['locale' => 'ar']) }}"
                                data-base-url="{{ route('home', ['locale' => 'ar']) }}">
                                <span class="fi fi-ae lang-flag-icon" aria-hidden="true"></span>
                                <span>{{ __('site.language_ar') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="#reservation" class="btn btn-primary py-4 px-lg-5 d-none d-lg-flex book-service-btn">{{ __('site.nav_book') }}</a>
        </div>
    </nav>

    @yield('content')

    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5" id="contact">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-light mb-4">{{ __('site.footer_address_title') }}</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><a class="text-reset" href="https://maps.app.goo.gl/bni7tTbRN394nurP8" target="_blank">{{ __('site.topbar_address') }}</a></p>
                    <p class="mb-2"><i class="fab fa-whatsapp me-3"></i><a class="text-reset" href="{{ __('site.topbar_whatsapp_link') }}">{{ __('site.topbar_whatsapp') }}</a></p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><a class="text-reset" href="tel:{{ __('site.topbar_phone') }}">{{ __('site.topbar_phone') }}</a></p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i><a class="text-reset" href="mailto:{{ __('site.contact_general_email') }}">{{ __('site.contact_general_email') }}</a></p>
                    <div class="d-flex pt-2">
                        {{--
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-youtube"></i></a>
                        --}}
                        <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/elite_axis.ae/"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h4 class="text-light mb-4">{{ __('site.footer_opening_title') }}</h4>
                    <h6 class="text-light">{{ __('site.footer_opening_days_1') }}</h6>
                    <p class="mb-4">{{ __('site.footer_opening_time_1') }}</p>
                    <h6 class="text-light">{{ __('site.footer_opening_days_2') }}</h6>
                    <p class="mb-0">{{ __('site.footer_opening_time_2') }}</p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h4 class="text-light mb-4">{{ __('site.footer_services_title') }}</h4>
                    <a class="btn btn-link" href="#services">{{ __('site.service_1_name') }}</a>
                    <a class="btn btn-link" href="#services">{{ __('site.service_2_name') }}</a>
                    <a class="btn btn-link" href="#services">{{ __('site.service_3_name') }}</a>
                    <a class="btn btn-link" href="#services">{{ __('site.service_4_name') }}</a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <iframe class="position-relative rounded w-100 h-100"
                    src="https://www.google.com/maps?q=Al%20Quoz%20Dubai&output=embed"
                    frameborder="0" style="min-height: 150px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    {{--
                    <h4 class="text-light mb-4">{{ __('site.footer_newsletter_title') }}</h4>
                    <p>{{ __('site.footer_newsletter_text') }}</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="{{ __('site.footer_newsletter_placeholder') }}">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">{{ __('site.footer_newsletter_button') }}</button>
                    </div>
                    --}}
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('site.brand') }}</a>, {{ __('site.footer_rights') }} {{ date('Y') }}
                    </div>
                    <div class="col-md-6 text-md-end">
                            {{ __('site.footer_developer') }} <a href="https://wa.me/971522299108" target="_blank">Roni Plus</a>
                        {{--
                        <div class="footer-menu">
                            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('site.nav_home') }}</a>
                            <a href="#contact">{{ __('site.footer_support') }}</a>
                            <a href="#contact">{{ __('site.footer_help') }}</a>
                            <a href="#contact">{{ __('site.footer_faqs') }}</a>
                        </div>
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('carserv/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('carserv/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('carserv/lib/waypoints/waypoints.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const langLinks = document.querySelectorAll('.lang-switcher-link');

            const syncLangLinksWithHash = () => {
                const currentHash = window.location.hash || '';
                langLinks.forEach((link) => {
                    const baseUrl = link.getAttribute('data-base-url');
                    if (baseUrl) {
                        link.setAttribute('href', `${baseUrl}${currentHash}`);
                    }
                });
            };

            syncLangLinksWithHash();
            window.addEventListener('hashchange', syncLangLinksWithHash);
        });
    </script>
    <script src="{{ asset('carserv/js/main.js') }}"></script>
</body>

</html>
