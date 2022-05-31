@extends('layouts.app')
@section('title')
    {{__('messages.staffs')}}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div id="kt_content_container" class="container">
        <div class="card">
            <div class="card-body pt-0 livewire-table">
                <livewire:staff-table/>
            </div>
        </div>
    </div>
@endsection
