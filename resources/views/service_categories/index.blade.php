@extends('layouts.app')
@section('title')
    {{__('messages.service_categories')}}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card">
                <div class="card-body pt-0 livewire-table">
                    <livewire:service-category-table/>
                </div>
            </div>
        </div>
    </div>
    @include('service_categories.create-modal')
    @include('service_categories.edit-modal')
@endsection
