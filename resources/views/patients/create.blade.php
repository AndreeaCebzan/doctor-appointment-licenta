@extends('layouts.app')
@section('title')
    {{ __('messages.patient.add') }}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <a href="{{ route('patients.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
            </div>
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
                            @include('layouts.errors')
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-12">
                            {{ Form::open(['route' => 'patients.store','files' => 'true','id' => 'createPatientForm']) }}
                            <div class="card-body p-9">
                                {{ Form::hidden('is_edit', false,['id' => 'patientIsEdit']) }}
                                {{ Form::hidden('backgroundImg',asset('web/media/avatars/male.png'),['id' => 'patientBackgroundImg']) }}
                                @include('patients.fields')
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
