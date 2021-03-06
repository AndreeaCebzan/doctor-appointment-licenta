<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Subscribe;

class SubscriberTable extends LivewireTableComponent
{
    /**
     * @var string[]
     */
    protected $listeners = [
        'refresh' => '$refresh','resetPage'
    ];

    /**
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return Subscribe::query();
    }

    /**
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns'       => $this->columns(),
                'rowView'       => $this->rowView(),
                'filtersView'   => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows'          => $this->rows,
                'modalsView'    => $this->modalsView(),
                'bulkActions'   => $this->bulkActions,
            ]);
    }

    /**
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('messages.user.email'), "email")
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'))->addClass('w-100px text-center'),
        ];
    }

    /**
     *
     * @return string
     */
    public function rowView(): string
    {
        return 'livewire-tables.rows.subscriber_table';
    }
}
