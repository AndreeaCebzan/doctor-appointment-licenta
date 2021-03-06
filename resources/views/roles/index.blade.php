@extends('layouts.app')
@section('title')
    {{__('messages.roles')}}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card">
                <div class="card-body pt-0 livewire-table">
                    <livewire:role-table/>
                </div>
            </div>
        </div>
    </div>
@endsection
