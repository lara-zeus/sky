<?php

use Illuminate\Support\Facades\Route;
use LaraZeus\Sky\Http\Livewire\Faq;
use LaraZeus\Sky\Http\Livewire\LibrarTag;
use LaraZeus\Sky\Http\Livewire\Library;
use LaraZeus\Sky\Http\Livewire\LibraryItem;
use LaraZeus\Sky\Http\Livewire\Page;
use LaraZeus\Sky\Http\Livewire\Post;
use LaraZeus\Sky\Http\Livewire\Posts;
use LaraZeus\Sky\Http\Livewire\Tags;
use LaraZeus\Sky\SkyPlugin;

$filament = app('filament');

if (! defined('__PHPSTAN_RUNNING__') && app('filament')->hasPlugin('zeus-sky')) {
    Route::prefix(SkyPlugin::get()->getSkyPrefix())
        ->middleware(SkyPlugin::get()->getMiddleware())
        ->group(function () {

            if (SkyPlugin::get()->hasFaqResource()) {
                Route::get(SkyPlugin::get()->getUriPrefix()['faq'], Faq::class)
                    ->name('faq');
            }

            if (SkyPlugin::get()->hasLibraryResource()) {
                Route::prefix(SkyPlugin::get()->getUriPrefix()['library'])->group(function () {
                    Route::get('/', Library::class)->name('library');
                    Route::get('/tag/{slug}', LibrarTag::class)->name('library.tag');
                    Route::get('/{slug}', LibraryItem::class)->name('library.item');
                });
            }

            Route::post('passwordConfirmation/{slug}', function ($slug) {

                $post = SkyPlugin::get()->getModel('Post')::query()
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

            Route::get('/', Posts::class)->name('blogs');
            Route::get(SkyPlugin::get()->getUriPrefix()['post'] . '/{slug}', Post::class)->name('post');
            Route::get(SkyPlugin::get()->getUriPrefix()['page'] . '/{slug}', Page::class)->name('page');
            Route::get('{type}/{slug}', Tags::class)->name('tags');
        });
}
