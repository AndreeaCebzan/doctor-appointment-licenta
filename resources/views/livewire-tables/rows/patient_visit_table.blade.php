<x-livewire-tables::bs5.table.cell>
    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
        <div class="symbol-label">
            <img src="{{ $row->visitDoctor->user->profile_image }}" alt=""
                 class="w-100 object-cover">
        </div>
    </div>
    <div class="d-inline-block align-top">
        <div class="d-inline-block align-self-center d-flex">
            <a class="text-primary-800 mb-1 d-block">
                {{ $row->visitDoctor->user->full_name }}
            </a>
            <div class="star-ratings d-inline-block align-self-center ms-2">
                <div class="avg-review-star-div d-flex align-self-center mb-1">
                    @php
                        $rating = $row->visitDoctor->reviews->avg('rating');
                    @endphp
                    @if(count($row->visitDoctor->reviews) != 0)
                        @for( $i = 1; $i <= 5; $i++ )
                            @if( $i <= $rating )
                                <i class="fas fa-star review-star"></i>
                            @else
                                <i class="far fa-star review-star"></i>
                            @endif
                        @endfor
                    @else
                        @for( $i = 0; $i < 5; $i++ )
                            <i class="far fa-star review-star"></i>
                        @endfor
                    @endif
                </div>
            </div>
        </div>
        <span class="d-block">{{ $row->visitDoctor->user->email }}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <span class="badge badge-light-info">{{ \Carbon\Carbon::parse($row->visit_date)->format('jS M, Y') }}</span>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="d-flex justify-content-center">
        <a href="{{ route('patients.patient.visits.show', $row->id) }}" title="{{ __('messages.common.show') }}"
           class="btn btn-icon btn-bg-light text-hover-primary btn-sm me-1" data-bs-toggle="tooltip">
            <i class="fas fa-eye fs-4"></i>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>
