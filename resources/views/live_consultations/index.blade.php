@extends('layouts.app')
@section('title')
    {{ __('messages.live_consultations') }}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card">
                {{Form::hidden('liveConsultationUrl',route('doctors.live-consultation.index'),['id' => 'liveConsultationUrl'])}}
                {{Form::hidden('liveConsultationTypeNumber',route('doctors.live.consultation.list'),['id' => 'liveConsultationTypeNumber'])}}
                {{Form::hidden('liveConsultationCreateUrl',route('doctors.live-consultation.store'),['id' => 'liveConsultationCreateUrl'])}}
                {{Form::hidden('zoomCredentialCreateUrl',route('doctors.zoom.credential.create'),['id' => 'zoomCredentialCreateUrl'])}}
                {{Form::hidden('doctorRole',getLogInUser()->hasRole('doctor')?true:false,['id' => 'doctorRole'])}}
                {{Form::hidden('adminRole',getLogInUser()->hasRole('admin')?true:false,['id' => 'adminRole'])}}
                {{Form::hidden('patientRole',getLogInUser()->hasRole('patient')?true:false,['id' => 'patientRole'])}}
                <div class="card-body pt-0 fs-6 py-8 px-8 overflow-auto px-lg-10 text-gray-700 livewire-table">
                    <livewire:live-consultations-table/>
                </div>
                @role('doctor')
                @include('live_consultations.add_modal')
                @include('live_consultations.edit_modal')
                @include('live_consultations.add_credential_modal')
                @endrole
                @include('live_consultations.show_consultation_modal')
                @include('live_consultations.start_modal')
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{--    <script>--}}
{{--            let liveConsultationUrl = "{{ route('doctors.live-consultation.index') }}";--}}
{{--            let liveConsultationTypeNumber = "{{ route('doctors.live.consultation.list') }}";--}}
{{--            let liveConsultationCreateUrl = "{{ route('doctors.live-consultation.store') }}";--}}
{{--            let zoomCredentialCreateUrl = "{{ route('doctors.zoom.credential.create') }}";--}}
{{--            let doctorRole = "{{getLogInUser()->hasRole('doctor')?true:false}}";--}}
{{--            let adminRole = "{{getLogInUser()->hasRole('admin')?true:false}}";--}}
{{--            let patientRole = "{{getLogInUser()->hasRole('patient')?true:false}}";--}}
{{--        </script>--}}
        <script src="{{asset('assets/js/plugins/flatpickr.js')}}"></script>
        <script src="{{asset('assets/js/live_consultations/live_consultations.js')}}"></script>
@endsection
