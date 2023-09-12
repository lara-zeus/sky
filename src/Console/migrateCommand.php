<?php

namespace LaraZeus\Sky\Console;

use Illuminate\Console\Command;
use LaraZeus\Sky\SkyPlugin;

class migrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sky:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update all posts and pages to support multi langs';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $posts = SkyPlugin::get()->getModel('Post')::get();
        foreach ($posts as $post) {
            $post->translatable = [];

            $title = $post->title;
            $content = $post->content;
            $description = $post->description;

            $post->translatable = [
                'title',
                'content',
                'description',
            ];

            if (! $this->isJson($title)) {
                $post->title = $title;
            }
            if (! $this->isJson($content)) {
                $post->content = $content;
            }
            if (! $this->isJson($description)) {
                $post->description = $description;
            }
            $post->save();
        }
    }

    public function isJson(string $string): bool
    {
        json_decode($string);

        return json_last_error() === JSON_ERROR_NONE;
    }
}
