<div class="fi-ta-text text-xs">
    {!! $getRecord()->statusDesc() !!} ·
    <span title="{{ $getRecord()->published_at }}">{{ optional($getRecord()->published_at)->diffForHumans() }}</span>
</div>
