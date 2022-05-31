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

class PatientShowPageAppointmentTable extends LivewireTableComponent
{
    public $statusFilter = Appointment::BOOKED;
    public $dateFilter = '';
    public $patientId;

    /**
     * @var string[]
     */
    protected $listeners = [
        'refresh' => '$refresh', 'changeStatusFilter', 'changeDateFilter','resetPage'
    ];

    /**
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Appointment::with(['doctor.user', 'doctor.reviews'])->where('patient_id', '=', $this->patientId);

        $query->when($this->statusFilter != '' && $this->statusFilter != Appointment::ALL_STATUS,
            function (Builder $q) {
                if ($this->statusFilter != Appointment::ALL) {
                    $q->where('status', '=', $this->statusFilter);
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

        return $query;
    }

    /**
     * @param $status
     */
    public function changeStatusFilter($status)
    {
        $this->statusFilter = $status;
    }

    /**
     * @param $date
     */
    public function changeDateFilter($date)
    {
        $this->dateFilter = $date;
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
                'componentFilter'   => 'patients.appointment_filter',
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
                    return $query->whereHas('doctor', function (Builder $q) {
                        $q->orderBy(User::select('first_name')->where('id', 'doctor.user_id'));
                    });
                })->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('doctor.user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),
            Column::make(__('messages.appointment.appointment_at'), 'date')
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.status')),
            Column::make(__('messages.common.action'))->addClass('w-100px text-center'),
        ];
    }

    /**
     *
     * @return string
     */
    public function rowView(): string
    {
        return 'livewire-tables.rows.patient_show_page_appointment_table';
    }
}
