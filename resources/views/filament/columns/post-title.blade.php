<div class="fi-ta-text">
    @if($getRecord()->password !== null)
        <span x-tooltip.raw="{{ __('Password Protected') }}" title="{{ __('Password Protected') }}">
            @svg('heroicon-s-lock-closed','w-4 h-4 inline-flex text-danger-600')
        </span>
    @endif

    @if($getRecord()->sticky_until !== null)
        <span x-tooltip.raw="{{ __('Sticky Until') }} {{ $getRecord()->sticky_until->diffForHumans() }}" title="{{ __('Sticky Until') }} {{ $getRecord()->sticky_until->diffForHumans() }}">
            @svg('iconpark-pin','w-4 h-4 inline-flex text-primary-600')
        </span>
    @endif

    {{ str($getRecord()->title)->limit(50) }}
</div>
