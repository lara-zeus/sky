<a href="/{{ $getRecord->slug }}" target="_blank" class="block">
    <div class="filament-tables-text-column text-primary-600 transition hover:underline hover:text-primary-500 focus:underline focus:text-primary-500">
        @if($getRecord->password !== null)
            <span x-tooltip.raw="{{ __('Password Protected') }}" title="{{ __('Password Protected') }}">
                <x-iconpark-lock class="w-4 h-4 inline-flex text-danger-600"/>
            </span>
        @endif
        {{ $getRecord->title }}
    </div>
</a>
