@php
    $book = \App\Models\Appointment::BOOKED;
    $allPaymentCount = \App\Models\Appointment::ALL_PAYMENT;
    $checkIn =  \App\Models\Appointment::CHECK_IN;
    $checkOut =  \App\Models\Appointment::CHECK_OUT;
    $cancel =  \App\Models\Appointment::CANCELLED;
    $pending = \App\Models\Appointment::PENDING;    
    $paid = \App\Models\Appointment::PAID;
    $paymentStatus = getAllPaymentStatus();
    $paymentGateway = getPaymentGateway();
@endphp
<x-livewire-tables::bs5.table.cell>
    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
        <a href="javascript:void(0)">
            <div class="symbol-label">
                <img src="{{ $row->doctor->user->profile_image}}" alt=""
                     class="w-100 object-cover">
            </div>
        </a>
    </div>
    <div class="d-inline-block align-top">
        <div class="d-inline-block align-self-center d-flex">
            <a class="text-primary-800 mb-1 d-inline-block align-self-center">{{$row->doctor->user->full_name}}</a>
            <div class="star-ratings d-inline-block align-self-center ms-2">

            </div>
        </div>
        <span class="d-block text-muted fw-bold">{{$row->doctor->user->email}}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="badge badge-light-info">
        <div class="mb-2">{{$row->from_time}} {{ $row->from_time_type }}
            - {{$row->to_time}} {{ $row->to_time_type}}</div>
        <div class="">{{ \Carbon\Carbon::parse($row->date)->format('jS M, Y') }}
        </div>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <span>{{ getCurrencyIcon() }} {{ number_format($row->payable_amount,2) }}</span>
</x-livewire-tables::bs5.table.cell>


<x-livewire-tables::bs5.table.cell>
    @if ($row->payment_type === 2)
        <span class="badge badge-light-success">{{ \App\Models\Appointment::PAYMENT_TYPE[$paid]}}</span>
    @else
        <span class="badge badge-light-danger">{{ \App\Models\Appointment::PAYMENT_TYPE[$pending] }}</span>
        <a href="javascript:void(0)" data-id="{{$row->id}}"
           class="btn btn-icon btn-bg-light text-hover-primary btn-sm me-1 payment-btn"
           data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="Appointment Payment">
            <i class="far fa-credit-card fs-4"></i>
        </a>
    @endif
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="w-120px d-flex align-items-center">
        <span class="bg-{{ getBadgeStatusColor($row->status) }} rounded-circle h-10px w-10px me-2"></span>
        <span class="">{{ \App\Models\Appointment::STATUS[$row->status]}}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="d-flex justify-content-center">
        @if($row->status !== $cancel && $row->status !== $checkOut)
            <a href="javascript:void(0)" data-id="{{$row->id}}"
               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-btn patient-cancel-appointment"
               data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="Cancel Appointment">
                <i class="fas fa-calendar-times text-danger fs-4"></i>
            </a>
        @endif

        <a href="{{ route('patients.appointment.detail', $row->id) }}"
           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm ms-1" data-bs-toggle="tooltip"
           title="{{ __('messages.common.show') }}">
            <i class="fas fa-eye fs-4"></i>
        </a>
        <a title="{{__('messages.common.delete')}}" href="javascript:void(0)" data-id="{{ $row->id }}"
           class="btn patient-panel-apptment-delete-btn btn-icon btn-bg-light text-hover-danger btn-sm ms-2"
           data-turbolinks="false">
                        <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                              fill="#000000" fill-rule="nonzero"></path>
                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                              fill="#000000" opacity="0.3"></path></g></svg></span>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>
