<div class="d-flex flex-sm-row flex-column align-items-center">
    @if ($paginationEnabled && $showPerPage)
        <div class="ms-0 ms-md-2 mb-sm-0 mb-3 d-flex align-items-center justify-content-sm-start justify-content-center">
            <span class="me-2 text-show">Show</span>
            <select
                    wire:model="perPage"
                    id="perPage"
                    class="form-select form-select-sm form-select-solid w-auto"
            >
                @foreach ($perPageAccepted as $item)
                    <option value="{{ $item }}">{{ $item === -1 ? __('All') : $item }}</option>
                @endforeach
            </select>
        </div>
    @endif

    @if ($showPagination)
        @if ($paginationEnabled && $rows->lastPage() > 1)
            <div class="w-100 d-flex justify-content-sm-between justify-content-center flex-wrap align-items-center flex-sm-row flex-column">
                <div class="ms-sm-3 pagination-record">
                    <span>@lang('Showing')</span>
                    {{ $rows->count() ? $rows->firstItem() : 0 }}
                    <span>@lang('to')</span>
                    {{ $rows->count() ? $rows->lastItem() : 0 }}
                    <span>@lang('of')</span>
                    {{ $rows->total() }}
                    <span>@lang('results')</span>
                </div>
                <div class="livewire-pagination mt-sm-0 mt-3">
                    @if($this->sortingEnabled)
                        @if($rows->currentPage() == $rows->lastPage())
                            {{ $this->resetPage($this->pageName()) }}
                        @endif
                    @endif
                    {{ $rows->links() }}
                </div>
            </div>
        @else
                <div class="w-100 d-flex justify-content-sm-between justify-content-center flex-wrap align-items-center flex-sm-row flex-column">
                    <div class="ms-sm-3 pagination-record text-gray-700 fw-bold">
                        @lang('Showing')
                        <strong>{{ $rows->count() }}</strong>
                        @lang('results')
                    </div>
                    <div class="livewire-pagination mt-sm-0 mt-3">
                        {{ $rows->links() }}
                    </div>
                </div>
        @endif
    @endif

</div>
