@php
    /** @var \App\Models\ClinicSchedule $clinicSchedule */
@endphp
<div class="align-items-center justify-content-between mt-md-0 mt-10">
    <div class="d-flex align-items-center mb-3 add-slot">
        <div class="d-inline-block">
        {{ Form::select('clinicStartTimes['.$day.']', $slots, isset($clinicSchedule) ? $clinicSchedule->start_time :  $slots[array_key_first($slots)] ,['class' => 'form-control form-control-solid form-select', 'data-control'=>'select2']) }}
        </div>
        <span class="small-border">-</span>
        <div class="d-inline-block">
            {{ Form::select('clinicEndTimes['.$day.']', $slots, isset($clinicSchedule) ? $clinicSchedule->end_time :  $slots[array_key_last($slots)],['class' => 'form-control form-control-solid form-select', 'data-control'=>'select2']) }}
        </div>
    </div>
</div>
