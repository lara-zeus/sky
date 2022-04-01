<div class="space-y-2 py-2">
    <a href="/{{ $getRecord->slug }}" target="_blank" class="block">
        <div class="filament-tables-text-column text-primary-600 transition hover:underline hover:text-primary-500 focus:underline focus:text-primary-500">
            @if($getRecord->password !== null)
                <span x-tooltip.raw="Password Protected" title="Password Protected" >
                    <x-heroicon-s-lock-closed class="w-4 h-4 inline-flex text-danger-600" />
                </span>
            @endif

            @if($getRecord->sticky_until !== null)
                <span x-tooltip.raw="sticky until {{ $getRecord->sticky_until->diffForHumans() }}" title="sticky until {{ $getRecord->sticky_until->diffForHumans() }}" >
                    <x-iconpark-pin class="w-4 h-4 inline-flex text-primary-600" />
                </span>
            @endif

            {{ $getRecord->title }}
        </div>
    </a>
    <div class="filament-tables-text-column text-xs">
        {!! $getRecord->status_desc !!} ·
        <span title="{{ $getRecord->published_at }}">{{ optional($getRecord->published_at)->diffForHumans() }}</span>
    </div>
</div>
