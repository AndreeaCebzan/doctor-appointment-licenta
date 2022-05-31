@extends('layouts.app')
@section('title')
    {{ __('messages.front_patient_testimonials') }}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div id="kt_content_container" class="container">
        <div class="card">
            <div class="card-body pt-0 livewire-table">
                <livewire:front-patient-testimonial-table/>
            </div>
        </div>
    </div>
@endsection
