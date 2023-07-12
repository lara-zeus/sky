<div>
    {{ method_exists($getRecord(),$getRecord()->type) ? $getRecord()->{$getRecord()->type}()->count() : 0 }}
</div>