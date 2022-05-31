@extends('layouts.app')
@section('title')
    {{__('messages.doctor.doctor_detail')}}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{asset('assets/css/plugins/daterangepicker.css')}}">
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex justify-content-end ms-auto">
                @if(!getLogInUser()->hasRole('patient'))
                    <div class="d-flex align-items-center py-1 me-2">
                        <a href="{{route('doctors.edit',$doctor->id)}}"
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
                {{Form::hidden('patient_role',getLogInUser()->hasRole('patient'),['id' => 'patientRoleDoctorDetail'])}}
                <div class="d-flex flex-column flex-xl-row">
                    @include('doctors.show_fields')
                </div>
            </div>
        </div>
    </div>
    @include('doctors.templates.templates')
@endsection
