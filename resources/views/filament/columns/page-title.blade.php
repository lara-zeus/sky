<div class="filament-tables-text-column text-primary-600">
    @if($getRecord()->password !== null)
        <span x-tooltip.raw="{{ __('Password Protected') }}" title="{{ __('Password Protected') }}">
            <x-iconpark-lock class="w-4 h-4 inline-flex text-danger-600"/>
        </span>
    @endif
    {{ $getRecord()->title }}
</div>
