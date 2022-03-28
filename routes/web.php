<?php

use Illuminate\Support\Facades\Route;
/*
Route::prefix(config('sky.path'))->name('sky.')->group(function () {
    Route::name('landingPage')->get('/', function () {
        return view('sky::forms.dashboard.landing');
    });

    Route::prefix(config('sky.user.prefix'))->name('user.')->middleware(config('sky.user.middleware'))->group(function () {
        Route::get('/', \LaraZeus\Sky\Http\Livewire\Dash\User::class)->name('dashboard');
    });

    Route::prefix(config('sky.admin.prefix'))->name('admin.')->middleware(config('sky.admin.middleware'))->group(function () {
        Route::get('categories', \LaraZeus\Sky\Http\Livewire\Forms\Admin\Categories::class)->name('categories');
    });

});*/