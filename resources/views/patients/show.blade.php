@extends('layouts.app')
@section('title')
    {{__('messages.patient.details')}}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex justify-content-end ms-auto">
                @if(!getLogInUser()->hasRole('doctor'))
                    <div class="d-flex align-items-center py-1 me-2">
                        <a href="{{route('patients.edit',$patient->id)}}"
                           class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder">{{ __('messages.common.edit') }}</a>
                    </div>
                @endif
                <div class="d-flex align-items-center py-1">
                    <a href="{{ url()->previous() }}"
                       class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid mt-lg-15" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card-title m-0">
                {{Form::hidden('patient_role',getLogInUser()->hasRole('patient'),['id' => 'patientRolePatientDetail'])}}
                <div class="d-flex flex-column flex-xl-row">
                    @include('patients.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
