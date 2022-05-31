@extends('layouts.app')
@section('title')
    {{ __('messages.appointments') }}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
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
            <div class="card pt-3">
                <div class="card-body pt-0 livewire-table">
                    <livewire:doctor-panel-appointment-table/>
                </div>
            </div>
        </div>
    </div>
    @include('doctor_appointment.models.doctor-payment-status-model')
@endsection
@push('page_js')
    <script>
        let userRole = '{{getLogInUser()->hasRole('doctor')}}'
    </script>
@endpush
