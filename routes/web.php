<?php

use Illuminate\Support\Facades\Route;
use LaraZeus\Sky\Http\Livewire\Faq;
use LaraZeus\Sky\Http\Livewire\Library;
use LaraZeus\Sky\Http\Livewire\LibraryItem;
use LaraZeus\Sky\Http\Livewire\LibraryTag;
use LaraZeus\Sky\Http\Livewire\Page;
use LaraZeus\Sky\Http\Livewire\Post;
use LaraZeus\Sky\Http\Livewire\Posts;
use LaraZeus\Sky\Http\Livewire\Tags;

$filament = app('filament');

Route::prefix(config('zeus-sky.prefix'))
    ->middleware(config('zeus-sky.middleware'))
    ->group(function () {

        if (in_array('FaqResource', config('zeus-sky.enabledResources'))) {
            Route::get(config('zeus-sky.uriPrefix.faq'), Faq::class)
                ->name('faq');
        }

        if (in_array('LibraryResource', config('zeus-sky.enabledResources'))) {
            Route::prefix(config('zeus-sky.uriPrefix.library'))
                ->group(function () {
                    Route::get('/', Library::class)->name('library');
                    Route::get('/tag/{slug}', LibraryTag::class)->name('library.tag');
                    Route::get('/{slug}', LibraryItem::class)->name('library.item');
                });
        }

        /*Route::post('passwordConfirmation/{slug}', function ($slug) {
            // convert to LW todo
            $post = SkyPlugin::get()->getModel('Post')::query()
                ->where('slug', $slug)
                ->where('password', request('password'))
                ->first();

            if ($post !== null) {
                request()->session()->put($slug.'-'.request('password'), request('password'));

                return redirect()->route($post->post_type, ['slug' => $post->slug]);
            }

            return redirect()->back()->with('status', __('sorry, the password incorrect!'));
        })
            ->name('passwordConfirmation');*/

        Route::get('/', Posts::class)->name('blogs');
        Route::get(config('zeus-sky.uriPrefix.post') . '/{slug}', Post::class)->name('post');
        Route::get(config('zeus-sky.uriPrefix.page') . '/{slug}', Page::class)->name('page');
        Route::get('{type}/{slug}', Tags::class)->name('tags');
    });
