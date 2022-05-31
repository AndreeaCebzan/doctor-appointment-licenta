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
        <a href="{{ route('patients.transactions.show',$row->id) }}"
           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip"
           title="{{ __('messages.common.show') }}">
            <i class="fas fa-eye fs-4"></i>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>
