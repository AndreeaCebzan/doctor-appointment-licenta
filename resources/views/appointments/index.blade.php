@extends('layouts.app')
@section('title')
    {{__('messages.appointment.appointments')}}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    {{Form::hidden('patientRole',getLogInUser()->hasRole('patient'),['id' => 'patientRole'])}}
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
                    <livewire:appointment-table/>
                    @include('appointments.models.patient-payment-model')
                </div>
            </div>
        </div>
    </div>
    @include('appointments.models.change-payment-status-model')
@endsection
{{--@section('page_js')--}}
{{--    <script>--}}
{{--        let userRole = '{{getLogInUser()->hasRole('patient')}}'--}}
{{--    </script>--}}
{{--    <script>--}}
{{--let book = "{{ \App\Models\Appointment::BOOKED }}"--}}
{{--let allPaymentCount = "{{\App\Models\Appointment::ALL_PAYMENT}}"--}}
{{--let checkIn = "{{ \App\Models\Appointment::CHECK_IN }}"--}}
{{--let checkOut = "{{ \App\Models\Appointment::CHECK_OUT }}"--}}
{{--let cancel = "{{ \App\Models\Appointment::CANCELLED }}"--}}
{{--let adminRole = true--}}
{{--let pending = "{{\App\Models\Appointment::PENDING}}"--}}
{{--let paid = "{{\App\Models\Appointment::PAID}}"--}}
{{--    </script>--}}
{{--    <script src="{{mix('assets/js/appointments/appointments.js')}}"></script>--}}
{{--@endsection--}}
