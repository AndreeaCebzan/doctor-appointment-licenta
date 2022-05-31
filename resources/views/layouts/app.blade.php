<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | {{ getAppName() }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset(getAppFavicon()) }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!-- General CSS Files -->
    @if(Auth::user()->dark_mode)
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party-dark.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ mix('assets/css/page-dark.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ mix('assets/css/page.css') }}">
    @endif
    @livewireStyles
    @routes

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
            data-turbolinks-eval="false" data-turbo-eval="false">
    </script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script data-turbo-eval="false">
        let stripe = '';
        @if(config('services.stripe.key'))
            stripe = Stripe('{{ config('services.stripe.key') }}');
        @endif
        let usersRole = '{{ !empty(getLogInUser()->roles->first()) ? getLogInUser()->roles->first()->name : '' }}';
        let currencyIcon = '{{ getCurrencyIcon() }}';
        let isSetFirstFocus = true;
        let womanAvatar = '{{ url(asset('web/media/avatars/female.png')) }}';
        let manAvatar = '{{ url(asset('web/media/avatars/male.png')) }}';
        let changePasswordUrl = "{{ route('user.changePassword') }}";
        let updateLanguageURL = "{{ route('change-language')}}";
        let phoneNo = '';
        let options = {
            'key': "{{ config('payments.razorpay.key') }}",
            'amount': 0, //  100 refers to 1
            'currency': 'INR',
            'name': "{{getAppName()}}",
            'order_id': '',
            'description': '',
            'image': '{{ asset(getAppLogo()) }}', // logo here
            'callback_url': "{{ route('razorpay.success') }}",
            'prefill': {
                'email': '', // recipient email here
                'name': '', // recipient name here
                'contact': '', // recipient phone here
                'appointmentID': '', // appointmentID here
            },
            'readonly': {
                'name': 'true',
                'email': 'true',
                'contact': 'true',
            },
            'theme': {
                'color': '#4FB281',
            },
            'modal': {
                'ondismiss': function () {
                    displayErrorMessage('Appointment created successfully and payment not completed.');
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                },
            },
        }
    </script>
    <script src="{{ mix('js/third-party.js') }}"></script>
    <script src="{{ mix('js/pages.js') }}"></script>
</head>
@php $styleCss = 'style'; @endphp
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed {{ (Auth::user()->dark_mode) ? 'dark-mode' : ''}}"
{{ $styleCss }}="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px"
data-new-gr-c-s-check-loaded="14.1025.0" data-gr-ext-installed="">
@yield('phone_js')
<div class="main-content">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            @include('layouts.sidebar')
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('layouts.header')
                <div class="d-flex flex-column flex-column-fluid" id="kt_content">
                    @yield('header_toolbar')
                    <div class="content d-flex flex-column flex-column-fluid header-top-padding" id="kt_post">
                        <div class="container" id="kt_content_container">
                            @yield('content')
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>

    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <span class="svg-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                         height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <rect fill="#000000" opacity="0.5" x="11" y="10" width="2" height="10" rx="1"/>
                            <path
                                d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                                fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg>
                </span>
    </div>
    @include('profile.changePassword')
    @include('profile.email_notification')
</div>
</body>
</html>
