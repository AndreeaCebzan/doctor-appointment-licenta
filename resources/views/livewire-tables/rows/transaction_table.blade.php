<x-livewire-tables::bs5.table.cell>
    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
        <div class="symbol-label">
            <img src="{{ $row->user->patient->profile }}" alt=""
                 class="w-100 object-cover">
        </div>
    </div>
    <div class="d-inline-block align-top">
        <a href="{{route('patients.show', $row->user->patient->id)}}"
           class="text-primary-800 mb-1 d-block">{{ $row->user->first_name.' '.$row->user->last_name }}</a>
        <span class="d-block">{{ $row->user->email }}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="badge badge-light-info">{{ \Carbon\Carbon::parse($row->created_at)->format('jS M, Y H:i A') }}</div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ \App\Models\Appointment::PAYMENT_METHOD[$row->type] }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ getCurrencyIcon().' '. number_format($row->amount) }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="d-flex justify-content-center">
        <a href="{{ route('transactions.show', $row->id) }}"
           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip"
           title="{{ __('messages.common.show') }}">
            <i class="fas fa-eye fs-4"></i>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>
