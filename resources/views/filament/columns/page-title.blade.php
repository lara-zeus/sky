<div class="fi-ta-text">
    @if($getRecord()->password !== null)
        <span x-tooltip.raw="{{ __('Password Protected') }}" title="{{ __('Password Protected') }}">
            @svg('heroicon-s-lock-closed','w-4 h-4 inline-flex text-danger-600')
        </span>
    @endif
    {{ str($getRecord()->title)->limit(50) }}
</div>
