<?php

use Illuminate\Support\Facades\Route;

Route::prefix(config('zeus-sky.prefix'))->name('sky.')->group(function () {

    Route::prefix(config('zeus-sky.path'))
        ->name('path.')
        ->middleware(config('zeus-sky.middleware'))
        ->group(function () {
            Route::get('/', [\LaraZeus\Sky\Http\Controllers\BlogController::class, 'index'])->name('blogs');
        });
});
