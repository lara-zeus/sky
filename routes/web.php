<?php

use Illuminate\Support\Facades\Route;
use LaraZeus\Sky\Http\Livewire\Faq;
use LaraZeus\Sky\Http\Livewire\Library;
use LaraZeus\Sky\Http\Livewire\LibraryItem;
use LaraZeus\Sky\Http\Livewire\Page;
use LaraZeus\Sky\Http\Livewire\Post;
use LaraZeus\Sky\Http\Livewire\Posts;
use LaraZeus\Sky\Http\Livewire\Tags;
use LaraZeus\Sky\SkyPlugin;

if (\LaraZeus\Sky\SkyPlugin::get()->hasFaqResource()) {
    Route::middleware(config('zeus-sky.middleware'))
        ->get(config('zeus-sky.uri_prefix.faq'), Faq::class)
        ->name('faq');
}

if (\LaraZeus\Sky\SkyPlugin::get()->hasLibraryResource()) {
    Route::middleware(config('zeus-sky.middleware'))
        ->prefix(config('zeus-sky.uri_prefix.library'))
        ->group(function () {
            Route::get('/', Library::class)->name('library');
            Route::get('/{slug}', LibraryItem::class)->name('library.item');
        });
}

Route::prefix(config('zeus-sky.path'))
    ->post('passwordConfirmation/{slug}', function ($slug) {

        $post = SkyPlugin::get()->getPostModel()::query()
            ->where('slug', $slug)
            ->where('password', request('password'))
            ->first();

        if ($post !== null) {
            request()->session()->put($slug . '-' . request('password'), request('password'));

            return redirect()->route($post->post_type, ['slug' => $post->slug]);
        }

        return redirect()->back()->with('status', __('sorry, the password incorrect!'));
    })
    ->name('passwordConfirmation');

Route::prefix(config('zeus-sky.path'))
    ->middleware(config('zeus-sky.middleware'))
    ->group(function () {
        Route::get('/', Posts::class)->name('blogs');
        Route::get(config('zeus-sky.uri_prefix.post') . '/{slug}', Post::class)->name('post');
        Route::get(config('zeus-sky.uri_prefix.page') . '/{slug}', Page::class)->name('page');
        Route::get('{type}/{slug}', Tags::class)->name('tags');
    });
