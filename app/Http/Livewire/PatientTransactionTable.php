<?php

namespace App\Http\Livewire;

use App\Models\PaymentGateway;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Transaction;

class PatientTransactionTable extends LivewireTableComponent
{
    /**
     * @var string[]
     */
    protected $listeners = [
        'refresh' => '$refresh','resetPage'
    ];

    /**
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('messages.appointment.date'), "created_at")
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.payment_method'), "type")
                ->sortable(),
            Column::make(__('messages.doctor_appointment.amount'), "amount")
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'))->addClass('w-50px text-center'),
        ];
    }

    /**
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return Transaction::where('user_id', '=', getLogInUserId());
    }

    /**
     *
     * @return string
     */
    public function rowView(): string
    {
        return 'livewire-tables.rows.patient_transaction_table';
    }
}
