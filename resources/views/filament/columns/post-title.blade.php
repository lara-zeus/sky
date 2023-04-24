<a href="{{ route('post',$getRecord()->slug) }}" target="_blank" class="block">
    <div class="filament-tables-text-column text-primary-600 transition hover:underline hover:text-primary-500 focus:underline focus:text-primary-500">
        @if($getRecord()->password !== null)
            <span x-tooltip.raw="{{ __('Password Protected') }}" title="{{ __('Password Protected') }}">
                <x-iconpark-lock class="w-4 h-4 inline-flex text-danger-600"/>
            </span>
        @endif

        @if($getRecord()->sticky_until !== null)
            <span x-tooltip.raw="{{ __('Sticky Until') }} {{ $getRecord()->sticky_until->diffForHumans() }}" title="{{ __('Sticky Until') }} {{ $getRecord()->sticky_until->diffForHumans() }}">
                <x-iconpark-pin class="w-4 h-4 inline-flex text-secondary-500"/>
            </span>
        @endif

        {{ $getRecord()->title }}
    </div>
</a>
