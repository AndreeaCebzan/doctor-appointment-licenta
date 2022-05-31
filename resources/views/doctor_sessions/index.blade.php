@extends('layouts.app')
@section('title')
    {{ __('messages.doctor_sessions') }}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card">
                {{Form::hidden('doctor_Session',getLogInUser()->hasRole('doctor') ? route('doctors.doctor-sessions.index') :
route('doctor-sessions.index'), ['id' => 'doctorSessionUrl'])}}
                <div class="card-body pt-0 livewire-table">
                    <livewire:doctor-schedule-table/>
                </div>
            </div>
        </div>
    </div>
@endsection
