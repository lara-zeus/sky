<div class="filament-tables-text-column text-xs">
    {!! $getRecord()->statusDesc() !!} ·
    <span title="{{ $getRecord()->published_at }}">{{ optional($getRecord()->published_at)->diffForHumans() }}</span>
</div>
