@extends('layouts.app')
@section('title')
    {{__('messages.countries')}}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post post d-flex flex-column-fluid mt-lg-15" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card">
                <div class="card-body pt-0  livewire-table">
                    <livewire:countries-table/>
                </div>
            </div>
        </div>
    </div>
    @include('countries.add-modal')
    @include('countries.edit-modal')
@endsection
