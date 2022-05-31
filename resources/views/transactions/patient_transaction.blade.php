@extends('layouts.app')
@section('title')
    {{ __('messages.transactions') }}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card">
                <div class="card-body pt-0 livewire-table">
                    <livewire:patient-transaction-table/>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--@section('page_js')--}}
{{--    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>--}}
{{--    <script>--}}
{{--        let manuallyMethod = "{{\App\Models\Appointment::MANUALLY}}"--}}
{{--        let stripeMethod = "{{\App\Models\Appointment::STRIPE}}"--}}
{{--        let paystckMethod = "{{\App\Models\Appointment::PAYSTACK}}"--}}
{{--        let paypalMethod = "{{\App\Models\Appointment::PAYPAL}}"--}}
{{--        let razorpayMethod = "{{\App\Models\Appointment::RAZORPAY}}"--}}
{{--        let authorizeMethod = "{{ \App\Models\Appointment::AUTHORIZE }}"--}}
{{--        let paytmMethod = "{{ \App\Models\Appointment::PAYTM }}"--}}
{{--        let manually = "{{\App\Models\Appointment::PAYMENT_METHOD[1]}}"--}}
{{--        let stripe = "{{\App\Models\Appointment::PAYMENT_METHOD[2]}}"--}}
{{--        let paystck = "{{\App\Models\Appointment::PAYMENT_METHOD[3]}}"--}}
{{--        let paypal = "{{\App\Models\Appointment::PAYMENT_METHOD[4]}}"--}}
{{--        let razorpay = "{{\App\Models\Appointment::PAYMENT_METHOD[5]}}"--}}
{{--        let authorize = "{{\App\Models\Appointment::PAYMENT_METHOD[6]}}"--}}
{{--        let paytm = "{{\App\Models\Appointment::PAYMENT_METHOD[7]}}"--}}
{{--    </script>--}}
{{--    <script src="{{mix('assets/js/transactions/patient-transactions.js')}}"></script>--}}
{{--@endsection--}}
