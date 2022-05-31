@props(['customSecondaryHeader' => false, 'useHeaderAsFooter' => false, 'customFooter' => false])

<div class="{{ $this->responsive ? 'table-responsive' : '' }}">
    <table {{ $attributes->except(['wire:sortable', 'class']) }} class="{{ trim($attributes->get('class')) ?: 'table table-responsive align-middle table-row-dashed fs-6 gy-5 dataTable no-footer w-100 white-space-nowrap'}}">
        <thead>
        <tr class="text-muted fw-bolder fs-7 text-uppercase gs-0">
            {{ $head }}
        </tr>
        </thead>

        <tbody {{ $attributes->only('wire:sortable') }} class="text-gray-600 fw-bold">
        @if ($customSecondaryHeader)
            {{ $customSecondaryHead }}
        @endif

        {{ $body }}
        </tbody>

        @if ($useHeaderAsFooter || $customFooter)
            <tfoot>
            @if ($useHeaderAsFooter)
                <tr>
                    {{ $head }}
                </tr>
            @elseif($customFooter)
                {{ $foot }}
            @endif
            </tfoot>
        @endif
    </table>
</div>
