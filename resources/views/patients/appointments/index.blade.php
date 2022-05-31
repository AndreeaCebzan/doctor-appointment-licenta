@extends('layouts.app')
@section('title')
    {{__('messages.appointment.appointments')}}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    {{Form::hidden('patient_appointment',getLogInUser()->hasRole('patient'),['id' => 'userRole'])}}
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end">
                        <div class="d-flex align-items-center">
                            <span class="w-10px h-10px bg-primary rounded-circle me-1"></span>
                            <span class="me-4">{{\App\Models\Appointment::STATUS[1]}}</span>
                            <span class="w-10px h-10px bg-success rounded-circle me-1"></span>
                            <span class="me-4">{{\App\Models\Appointment::STATUS[2]}}</span>
                            <span class="w-10px h-10px bg-warning rounded-circle me-1"></span>
                            <span class="me-4">{{\App\Models\Appointment::STATUS[3]}}</span>
                            <span class="w-10px h-10px bg-danger rounded-circle me-1"></span>
                            <span class="me-4">{{\App\Models\Appointment::STATUS[4]}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body pt-0 livewire-table">
                    <livewire:patient-appointment-table/>
                </div>
            </div>
        </div>
    </div>
    @include('appointments.models.patient-payment-model')
@endsection
@section('page_js')

    <script src="//js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        {{--let statusArray = JSON.parse('@json(\App\Models\Appointment::STATUS)')--}}
        {{--let appointmentStripePaymentUrl = '{{ url('appointment-stripe-charge') }}'--}}
        let stripe = '';
        @if(config('services.stripe.key'))
            stripe = Stripe('{{ config('services.stripe.key') }}');
        @endif
        let pending = "{{\App\Models\Appointment::PAYMENT_TYPE[1]}}"
        let paid = "{{\App\Models\Appointment::PAYMENT_TYPE[2]}}"
        let stripeMethod = "{{\App\Models\Appointment::STRIPE}}"
        let paystackMethod = "{{\App\Models\Appointment::PAYSTACK}}"
        let paypalMethod = "{{\App\Models\Appointment::PAYPAL}}"
        let allPaymentCount = "{{\App\Models\Appointment::ALL_PAYMENT}}"
        let razorpayMethod = "{{ \App\Models\Appointment::RAZORPAY }}"
        let authorizeMethod = "{{ \App\Models\Appointment::AUTHORIZE }}"
        let paytmMethod = "{{ \App\Models\Appointment::PAYTM }}"
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
                    $('#paymentGatewayModal').modal('hide')
                    displayErrorMessage('Payment not completed.')
                    setTimeout(function () {
                        location.reload()
                    }, 1000)
                },
            },
        }
    </script>
    {{--    <script src="{{mix('assets/js/appointments/patient-appointments.js')}}"></script>--}}
@endsection
