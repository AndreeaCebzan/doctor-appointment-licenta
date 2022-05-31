@extends('layouts.app')
@section('title')
    {{ __('messages.doctor_session.edit') }}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                    {{ (Auth::user()->hasRole('doctor')) ? __('messages.doctor_session.my_schedule') : __('messages.doctor_session.edit') }}
                </h1>
            </div>
            @if(getLogInUser()->hasRole('doctor'))
                <div class="d-flex align-items-center py-1 ms-auto">
                    <a href="{{ route('doctors.doctor.schedule.edit') }}"
                       class="d-none" id="btnBack">{{ __('messages.common.back') }}</a>
                </div>
            @else
                <div class="d-flex align-items-center py-1 ms-auto">
                    <a href="{{ url()->previous() }}"
                       class="btn btn-sm btn-primary" id="btnBack">{{ __('messages.common.back') }}</a>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid mt-lg-15" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                    <div class="row">
                        <div class="col-12">
                            @include('flash::message')
                            @include('layouts.errors')
                        </div>
                    </div>
                    {{ Form::hidden('is_edit', true,['id' => 'doctorSessionIsEdit']) }}
                    {{ Form::hidden('get_slot_url', getLogInUser()->hasRole('doctor') ? url('doctors/get-slot-by-gap') : route('get.slot.by.gap'),['id' => 'getSlotByGapUrl']) }}
                    <div class="card">
                        <div class="card-body p-12">
                            @if(getLogInUser()->hasRole('doctor'))
                                {{ Form::model($doctorSession,['route' => ['doctors.doctor-sessions.update', $doctorSession->id], 'method' => 'patch','id' => 'saveFormDoctor']) }}
                            @else
                                {{ Form::model($doctorSession,['route' => ['doctor-sessions.update', $doctorSession->id], 'method' => 'patch','id' => 'saveFormDoctor']) }}
                            @endif
                            <div class="">
                                @if(getLogInUser()->hasRole('doctor'))
                                    @include('doctor_sessions.doctor_schedule_edit')
                                @else
                                    @include('doctor_sessions.fields')
                                @endif
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('doctor_sessions.templates.templates')

