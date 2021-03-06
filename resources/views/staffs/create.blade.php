@extends('layouts.app')
@section('title')
    {{__('messages.staff.add_staff')}}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center ms-auto py-1">
                <a href="{{ route('staff.index') }}"
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
                            {{ Form::open(['route' => 'staff.store','files' => 'true','id' => 'createStaffForm'])}}
                            {{ Form::hidden('is_edit', false,['id' => 'staffIsEdit']) }}
                            <div class="card-body p-9">
                                @include('staffs.fields')
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        phoneNo = "{{ old('region_code').old('contact') }}";
    </script>
@endsection
{{--@section('page_js')--}}
{{--    <script src="{{ asset('assets/js/intl/js/intlTelInput.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/intl/js/utils.min.js') }}"></script>--}}
{{--@endsection--}}
{{--@section('scripts')--}}
{{--    <script>--}}
{{--        let isEdit = false;--}}
{{--        let utilsScript = "{{asset('assets/js/intl/js/utils.min.js')}}";--}}
{{--        let backgroundImg = "{{ asset('web/media/avatars/male.png') }}";--}}
{{--        let phoneNo = "{{ old('region_code').old('contact') }}";--}}
{{--    </script>--}}
{{--    <script src="{{ asset('assets/js/custom/phone-number-country-code.js') }}"></script>--}}
{{--    <script src="{{ mix('assets/js/staff/create-edit.js') }}"></script>--}}
{{--@endsection--}}

