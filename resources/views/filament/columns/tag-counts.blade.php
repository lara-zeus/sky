<div>
    {{ $getRecord()->{$getRecord()->type}()->count() ?? 0 }}
</div>