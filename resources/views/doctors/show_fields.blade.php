<div class="col-12">
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img class="object-cover" src="{{ $doctorDetailData['data']->user->profile_image }}"
                             alt="image"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <span
                                        class="text-gray-800 text-hover-primary fs-2 fw-bolder me-4">{{ $doctorDetailData['data']->user->full_name }}</span>
                                <a href="javascript:void(0)"
                                   class="btn btn-sm btn-light-{{ $doctorDetailData['data']->user->status === 1 ? 'success' : 'danger' }} fw-bolder ms-2 fs-8 py-1 px-3">{{ ($doctorDetailData['data']->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</a>
                            </div>
                            <div class="flex-wrap fw-bold fs-6 pe-2">
                                <span
                                        class="d-flex align-items-center text-gray-400 text-hover-primary mb-2 me-2">
                                    <span class="svg-icon svg-icon-3 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                             height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                  fill="black"></path>
                                            <path
                                                    d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                    fill="black"></path>
                                        </svg>
                                    </span>
                                    {{ $doctorDetailData['data']->user->email }}
                                </span>
                                <span
                                        class="d-flex align-items-center text-gray-400 text-hover-primary me-2">
                                    <i class="fas fa-phone-square-alt fs-4 mx-1"></i>
                                {{ !empty($doctorDetailData['data']->user->contact) ? '+'. 
$doctorDetailData['data']->user->region_code .' '. $doctorDetailData['data']->user->contact  : __('messages.common.n/a') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-stack">
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <div class="d-flex flex-wrap">
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-book-medical fa-2x me-2 text-primary"></i>
                                        <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"
                                             data-kt-countup-value="{{$doctorDetailData['totalAppointmentCount']}}">
                                            0
                                        </div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">{{__('messages.doctor_dashboard.total_appointments')}}</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt fa-2x me-2 text-dark"></i>
                                        <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"
                                             data-kt-countup-value="{{$doctorDetailData['todayAppointmentCount']}}">0
                                        </div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">{{__('messages.admin_dashboard.today_appointments')}}</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-book-medical fa-2x me-2 text-warning"></i>
                                        <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"
                                             data-kt-countup-value="{{$doctorDetailData['upcomingAppointmentCount']}}">0
                                        </div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">{{__('messages.patient_dashboard.upcoming_appointments')}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex overflow-auto h-55px">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" id="overview"
                           href="#patientOverview">{{ __('messages.common.overview') }}</a>
                    </li>
                    @if(!getLogInUser()->hasRole('patient'))
                        <li class="nav-item">
                            <a class="nav-link text-active-primary" data-bs-toggle="tab" id="appointments"
                               href="#pappointments">{{ __('messages.appointments') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="patientOverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.common.overview')  }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.doctor.specialization')  }}</label>
                            <div class="col-lg-8">
                                @foreach($doctorDetailData['data']->specializations as $specialization)
                                    <span class="badge my-1 me-1 badge-light-{{ getBadgeColor($loop->index) }}">{{ $specialization->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.patient.blood_group') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($doctorDetailData['data']->user->blood_group) ? \App\Models\Doctor::BLOOD_GROUP_ARRAY[$doctorDetailData['data']->user->blood_group] : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.gender') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{ ($doctorDetailData['data']->user->gender == 1) ? __('messages.doctor.male') : __('messages.doctor.female') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.doctor.dob') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($doctorDetailData['data']->user->dob) ? \Carbon\Carbon::parse($doctorDetailData['data']->user->dob)->format('jS M, Y') : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.doctor.experience') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($doctorDetailData['data']->experience) ? $doctorDetailData['data']->experience : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.setting.address') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($doctorDetailData['data']->user->address->address1) ? $doctorDetailData['data']->user->address->address1 : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.patient.registered_on') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2 " data-bs-toggle="tooltip"
                                      data-bs-placement="right"
                                      title="{{\Carbon\Carbon::parse($doctorDetailData['data']->user->created_at)->format('jS M Y')}}">{{$doctorDetailData['data']->user->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.patient.last_updated') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2" data-bs-toggle="tooltip"
                                      data-bs-placement="right"
                                      title="{{\Carbon\Carbon::parse($doctorDetailData['data']->user->updated_at)->format('jS M Y')}}">{{$doctorDetailData['data']->user->updated_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pappointments" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.appointments') }}</h3>
                    </div>
                </div>
                <div id="kt_content_container" class="container">
                    <div class="card">
                        <div class="card-body pt-0 livewire-table">
                            <livewire:doctor-appointment-table :doctorId="$doctor->id"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
