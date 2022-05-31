<x-livewire-tables::bs5.table.cell>
    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
        <div class="symbol-label">
            <img src="{{ $row->visitDoctor->user->profile_image }}" alt=""
                 class="w-100 object-cover">
        </div>
    </div>
    <div class="d-inline-block align-top">
        <div class="d-inline-block align-self-center d-flex">
            <a href="{{route('doctors.show', $row->id)}}"
               class="text-primary-800 mb-1 d-block">{{ $row->visitDoctor->user->full_name }}
            </a>
            <div class="star-ratings d-inline-block align-self-center ms-2">
                <div class="avg-review-star-div d-flex align-self-center mb-1">
                    @if($row->visitDoctor->reviews->avg('rating') != 0)
                        @php
                            $rating = $row->visitDoctor->reviews->avg('rating');
                        @endphp
                        @foreach(range(1, 5) as $i)
                            <div class="avg-review-star-div d-flex align-self-center mb-1">
                                @if($rating > 0)
                                    @if($rating > 0.5)
                                        <i class="fas fa-star review-star"></i>
                                    @else
                                        <i class="fas fa-star-half-alt review-star"></i>
                                    @endif
                                @else
                                    <i class="far fa-star review-star"></i>
                                @endif
                            </div>
                            @php $rating--; @endphp
                        @endforeach
                    @else
                        @foreach(range(1, 5) as $i)
                            <div class="avg-review-star-div d-flex align-self-center mb-1">
                                <i class="far fa-star review-star"></i>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <span class="d-block">{{ $row->visitDoctor->user->email }}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
        <div class="symbol-label">
            <img src="{{ $row->visitPatient->profile }}" alt=""
                 class="w-100 object-cover">
        </div>
    </div>
    <div class="d-inline-block align-top">
        <a href="{{route('doctors.show', $row->id)}}"
           class="text-primary-800 mb-1 d-block">{{ $row->visitPatient->user->full_name}}</a>
        <span class="d-block">{{ $row->visitPatient->user->email }}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <span class="badge badge-light-info">{{ \Carbon\Carbon::parse($row->visit_date)->format('jS M, Y') }}</span>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="d-flex justify-content-center">
        <a href="{{ route('visits.edit', $row->id) }}"
           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-btn" data-bs-toggle="tooltip"
           title="{{ __('messages.common.edit') }}">
            <span class="svg-icon svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304                             L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966                              17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                          fill="#000000" fill-rule="nonzero"
                          transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"/>
                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695                            4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153                                  22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                          fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                </svg>
            </span>
        </a>
        <a href="{{ route('visits.show', $row->id) }}" title="{{ __('messages.common.show') }}"
           class="btn btn-icon btn-bg-light text-hover-primary btn-sm ms-1" data-bs-toggle="tooltip">
            <i class="fas fa-eye fs-4"></i>
        </a>
        <a href="javascript:void(0)" data-id="{{ $row->id }}"
           class="visit-delete-btn btn btn-icon btn-bg-light text-hover-danger btn-sm ms-2" data-bs-toggle="tooltip"
           title="{{ __('messages.common.delete') }}">
            <span class="svg-icon svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                              fill="#000000" fill-rule="nonzero"/>
                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763                                 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5                                         18.5,4.5 L14,4.5 Z"
                              fill="#000000" opacity="0.3"/>
                    </g>
                </svg>
            </span>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>
