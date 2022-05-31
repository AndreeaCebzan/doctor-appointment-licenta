<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Appointment;

class AppointmentTable extends LivewireTableComponent
{
    public $statusFilter = Appointment::BOOKED;
    public $paymentTypeFilter = '';
    public $paymentStatusFilter = '';
    public $dateFilter = '';

    /**
     * @var string[]
     */
    protected $listeners = [
        'refresh' => '$refresh', 'changeStatusFilter', 'changePaymentTypeFilter', 'changeDateFilter','resetPage'
    ];

    /**
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Appointment::with([
            'doctor.user', 'patient.user', 'services', 'transaction', 'doctor.reviews',
        ]);

        $query->when($this->statusFilter != '' && $this->statusFilter != Appointment::ALL_STATUS,
            function (Builder $q) {
                if ($this->statusFilter != Appointment::ALL) {
                    $q->where('status', '=', $this->statusFilter);
                }
            });

        $query->when($this->paymentTypeFilter != '' && $this->paymentTypeFilter != Appointment::ALL_PAYMENT,
            function (Builder $q) {
                $q->where('payment_type', '=', $this->paymentTypeFilter);
            });

        $query->when($this->paymentStatusFilter != '',
            function (Builder $q) {
                if ($this->paymentStatusFilter != Appointment::ALL_PAYMENT) {
                    if ($this->paymentStatusFilter == Appointment::PENDING) {
                        $q->has('transaction', '=', null);
                    } elseif ($this->paymentStatusFilter == Appointment::PAID) {
                        $q->has('transaction', '!=', null);
                    }
                }
            });

        if ($this->dateFilter != '' && $this->dateFilter != getWeekDate()) {
            $timeEntryDate = explode(' - ', $this->dateFilter);
            $startDate = Carbon::parse($timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::parse($timeEntryDate[1])->format('Y-m-d');
            $query->whereBetween('date', [$startDate, $endDate]);
        } else {
            $timeEntryDate = explode(' - ', getWeekDate());
            $startDate = Carbon::parse($timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::parse($timeEntryDate[1])->format('Y-m-d');
            $query->whereBetween('date', [$startDate, $endDate]);
        }

        if (getLoginUser()->hasRole('patient')) {
            $query->where('patient_id', getLoginUser()->patient->id);
        }

        return $query;
    }

    /**
     * @param $status
     */
    public function changeStatusFilter($status)
    {
        $this->statusFilter = $status;
        $this->resetPage($this->pageName());
    }

    /**
     * @param $type
     */
    public function changePaymentTypeFilter($type)
    {
        $this->paymentTypeFilter = $type;
        $this->resetPage($this->pageName());
    }

    /**
     * @param $date
     */
    public function changeDateFilter($date)
    {
        $this->dateFilter = $date;
        $this->resetPage($this->pageName());
    }

    /**
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        $appointmentStatus = Appointment::ALL_STATUS;

        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns'           => $this->columns(),
                'rowView'           => $this->rowView(),
                'filtersView'       => $this->filtersView(),
                'customFilters'     => $this->filters(),
                'rows'              => $this->rows,
                'modalsView'        => $this->modalsView(),
                'bulkActions'       => $this->bulkActions,
                'componentFilter'   => 'appointments.filter',
                'componentName'     => 'appointments.add_button',
                'appointmentStatus' => $appointmentStatus,
            ]);
    }

    /**
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('messages.doctor.doctor'), 'doctor.user.first_name')
                ->sortable(function (Builder $query) {
                    return $query->whereHas('doctor.user', function (Builder $q) {
                        $q->orderBy(User::select('first_name')->where('id', 'doctor.user_id'));
                    });
                })->searchable(),
            Column::make(__('messages.appointment.patient'), 'patient.user.first_name')
                ->sortable(function (Builder $query) {
                    return $query->whereHas('patient.user', function (Builder $q) {
                        $q->orderBy(User::select('first_name')->where('id', 'patient.user_id'));
                    });
                })->searchable(),
            Column::make(__('messages.appointment.appointment_at'), 'date')
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.payment'))->addClass('text-center'),
            Column::make(__('messages.appointment.status'))->addClass('text-center'),
            Column::make(__('messages.common.action'))->addClass('w-100px text-center'),
        ];
    }

    /**
     *
     * @return string
     */
    public function rowView(): string
    {
        return 'livewire-tables.rows.appointment_table';
    }
}
