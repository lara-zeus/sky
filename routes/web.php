<?php

use Illuminate\Support\Facades\Route;
use LaraZeus\Sky\Http\Controllers\HomeController;

//Route::prefix(config('zeus-sky.prefix'))->name('sky.')->group(function () {
    Route::prefix(config('zeus-sky.path'))
        ->middleware(config('zeus-sky.middleware'))
        ->group(function () {
            Route::get('/', \LaraZeus\Sky\Http\Livewire\Posts::class)->name('blogs');
            Route::get('/{post:slug}', \LaraZeus\Sky\Http\Livewire\Post::class)->name('post');


            Route::get('cat/{slug}', [HomeController::class, 'cat']);
            Route::get('tag/{slug}', [HomeController::class, 'tag']);

            //Route::get('sitemap.xml', [SitemapXmlController::class, 'index']);

            //Route::post('passConf', [HomeController::class, 'passConf']);

            Route::get('page/{slug}', [HomeController::class, 'page']);





        });
//});
