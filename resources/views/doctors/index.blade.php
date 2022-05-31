@extends('layouts.app')
@section('title')
    {{__('messages.doctors')}}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card">
                <div class="card-body pt-0 livewire-table">
                    <livewire:doctor-table/>
                </div>
            </div>
        </div>
    </div>
    @include('doctors.qualification-modal')
@endsection
@section('page_js')
    <script>
        let all = '{{ \App\Models\User::ALL }}'
        let active = '{{ \App\Models\User::ACTIVE }}'
        let deactive = '{{ \App\Models\User::DEACTIVE }}'
    </script>
@endsection
