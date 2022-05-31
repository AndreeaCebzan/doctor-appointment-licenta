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
                <img src="{{ $row->patient->profile}}" alt=""
                     class="w-100 object-cover">
            </div>
        </a>
    </div>
    <div class="d-inline-block align-top">
        <div class="d-inline-block align-self-center d-flex">
            <a class="text-primary-800 mb-1 d-inline-block align-self-center">{{$row->patient->user->full_name}}</a>
            <div class="star-ratings d-inline-block align-self-center ms-2">

            </div>
        </div>
        <span class="d-block text-muted fw-bold">{{$row->patient->user->email}}</span>
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
    <select class="form-select-sm form-select-solid form-select doctor-apptment-change-payment-status payment-status"
            data-control="select2"
            data-id="{{$row->id}}">
        <option value="{{ $paid }}" {{( $row->payment_type ==
                $paid) ? 'selected' : ''}}>Paid
        </option>
        <option value="{{$pending}}" {{( $row->payment_type ==
                $paid) ? 'disabled' : 'selected'}}>Pending
        </option>
    </select>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="w-150px d-flex align-items-center">
        <span class="slot-color-dot bg-{{getBadgeStatusColor($row->status)}} rounded-circle me-2"></span>
        <select class="form-select-sm form-select-solid form-select doctor-appointment-status-change appointment-status"
                data-control="select2"
                data-id="{{$row->id}}">
            <option class="booked" disabled value="{{ $book}}" {{$row->status ==
                    $book ? 'selected' : ''}}>Booked
            </option>
            <option value="{{ $checkIn}}" {{$row->status ==
                    $checkIn ? 'selected' : ''}} {{$row->status == $checkIn
            ? 'selected'
            : ''}} {{( $row->status == $cancel || $row->status == $checkOut)
            ? 'disabled'
            : ''}}>Check In
            </option>
            <option value="{{ $checkOut}}" {{$row->status ==
                    $checkOut ? 'selected' : ''}} {{($row->status == $cancel ||
            $row->status == $book) ? 'disabled' : ''}}>Check Out
            </option>
            <option value="{{$cancel}}" {{$row->status ==
                    $cancel ? 'selected' : ''}} {{$row->status == $checkIn
            ? 'disabled'
            : ''}} {{$row->status == $checkOut ? 'disabled' : ''}}>Cancelled
            </option>
        </select>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="d-flex justify-content-center">
        <a href="{{ route('doctors.appointment.detail', $row->id) }}"
           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip"
           title="{{ __('messages.common.show') }}">
            <i class="fas fa-eye fs-4"></i>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>
