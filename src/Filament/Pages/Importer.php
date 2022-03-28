<?php

namespace LaraZeus\Sky\Filament\Pages;

use Corcel\Model\Post;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Schema;
use LaraZeus\Sky\Models\Post as zeusPost;
use LaraZeus\Sky\Models\Tag;

class Importer extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'zeus-sky::pages.importer';

    public bool $truncate = false;
    public bool $overwrite = false;

    public function submit()
    {
        if ($this->truncate) {
            $posts = zeusPost::all();
            $posts->each(function ($item, $key) {
                $item->tags()->detach();
                $item->delete();
            });
            Schema::disableForeignKeyConstraints();
            Tag::truncate();
            Schema::enableForeignKeyConstraints();
            $this->notify('primary', 'all tables has been truncated');
        }

        // get by status todo
        // get by post type todo
        $posts = Post::where('post_status','!=','inherit')->get();
        foreach ($posts as $post) {
            $zeusPost = $this->savePost($post);
            $tags = $post->taxonomies()->get();

            if (!$tags->isEmpty()) {
                $zeusPost->syncTagsWithType($tags->where('taxonomy','post_tag')->pluck('term.name')->toArray(),'tag');
                $zeusPost->syncTagsWithType($tags->where('taxonomy','category')->pluck('term.name')->toArray(),'category');
            }
        }

        $this->notify('success', 'Done!');
    }

    public function savePost($post)
    {
        $zeusPost = zeusPost::findOrNew($post->ID);
        if (!$zeusPost->exists || $this->overwrite) {
            $zeusPost->id = $post->ID;
            $zeusPost->title = $post->post_title;
            $zeusPost->slug = $post->slug;
            $zeusPost->description = $post->post_excerpt;
            $zeusPost->status = $post->post_status;
            $zeusPost->password = !empty($post->post_password) ? $post->post_password : null;
            $zeusPost->post_type = $post->post_type;
            $zeusPost->content = $post->post_content;
            $zeusPost->user_id = $post->post_author;
            $zeusPost->parent_id = $post->post_parent;
            $zeusPost->featured_image = $post->title;
            $zeusPost->created_at = $post->post_date;
            $zeusPost->published_at = $post->post_date;
            $zeusPost->save();
        }

        return $zeusPost;
    }

    protected function getFormSchema(): array
    {
        return [
            Card::make()->id('main-card')->columns(2)->schema([
                Toggle::make('truncate')->label('Truncate')->helperText('truncate the current Posts table'),
                Toggle::make('overwrite')->label('Overwrite')->helperText('overwrite all existences posts'),
            ])
        ];
    }

    protected function getForms(): array
    {
        return array_merge(parent::getForms(), [
            'form' => $this->makeForm()
                ->schema($this->getFormSchema())
                ->columns(2),
        ]);
    }
}
