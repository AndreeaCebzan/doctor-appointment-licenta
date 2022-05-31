@extends('layouts.app')
@section('title')
    {{ __('messages.visits') }}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card">
                <div class="card-body pt-0 livewire-table">
                    @if(getLogInUser()->hasRole('doctor'))
                        <livewire:doctor-visit-table/>
                    @else
                        <livewire:visit-table/>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
{{--@section('scripts')--}}
{{--    <script>--}}
{{--        let visitUrl = "{{ route('visits.index') }}";--}}
{{--        let doctorVisitUrl = "{{ route('doctors.visits.index') }}";--}}
{{--    </script>--}}
{{--    @if(getLogInUser()->hasRole('doctor'))--}}
{{--        <script>--}}
{{--            let doctorRole = '{{getLogInUser()->hasRole('doctor')}}';--}}
{{--        </script>--}}
{{--        <script src="{{mix('assets/js/visits/doctor-visit.js')}}"></script>--}}
{{--    @else--}}
{{--        <script src="{{mix('assets/js/visits/visits.js')}}"></script>--}}
{{--    @endif--}}
{{--@endsection--}}
