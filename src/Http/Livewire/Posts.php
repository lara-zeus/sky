<?php

namespace LaraZeus\Sky\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;
use Livewire\Component;

class Posts extends Component
{
    public function render()
    {
        $search = strtolower(request('search'));

        $posts = Post::NotSticky();
        $posts = $this->applySearch($posts, $search);
        $posts = $posts
            ->orderBy('published_at', 'desc')
            ->get();

        $pages = Post::page();
        $pages = $this->applySearch($pages, $search);
        $pages = $pages
            ->orderBy('published_at', 'desc')
            ->whereNull('parent_id')
            ->get();

        $pages = $this->highlightSearchResults($pages, $search);
        $posts = $this->highlightSearchResults($posts, $search);

        $recent = Post::posts()
                    ->limit(config('zeus-sky.site_recent_count', 5))
                    ->orderBy('published_at', 'desc')
                    ->get();

        seo()
            ->title(__('Posts'))
            ->description(__('Posts') . ' ' . config('zeus-sky.site_description', 'Laravel'))
            ->site(config('zeus-sky.site_title', 'Laravel'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="'.asset('favicon/favicon.ico').'">')
            ->rawTag('<meta name="theme-color" content="'.config('zeus-sky.site_color').'" />')
            ->withUrl()
            ->twitter();

        return view(app('theme').'.home')
            ->with([
                'posts'    => $posts,
                'pages'    => $pages,
                'recent'   => $recent,
                'tags'     => Tag::withCount('postsPublished')->where('type', 'category')->get(),
                'stickies' => Post::sticky()->get(),
            ])
            ->layout(config('zeus-sky.layout'));
    }

    private function applySearch(Builder $query, string $search): Builder
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                foreach (['title', 'slug', 'content', 'description'] as $attribute) {
                    $query->orWhere(DB::raw("lower($attribute)"), 'like', "%$search%");
                }

                return $query;
            });
        }

        return $query;
    }

    private function highlightSearchResults(Collection $posts, ?string $search = null): Collection
    {
        if (! $search) {
            return $posts;
        }

        foreach ($posts as $i => $post) {
            $posts[$i]->title = static::hl($post->title, [$search]);
            $posts[$i]->content = static::hl($post->content, [$search]);
            $posts[$i]->description = static::hl($post->description, [$search]);
        }

        return $posts;
    }

    /**
     * Credits for this code goes to link below.
     *
     * @link https://stackoverflow.com/questions/8564578/php-search-text-highlight-function
     */
    public static function hl(string $inp, array $words): string
    {
        $class = config('zeus-sky.search_result_highlight_css_class', 'highlight');
        $replace = array_flip(array_flip($words));
        $pattern = [];

        foreach ($replace as $k => $fword) {
            $pattern[] = '/\b('.$fword.')(?!>)\b/i';
            $replace[$k] = sprintf('<span class="%s">$1</span>', $class);
        }

        return preg_replace($pattern, $replace, $inp);
    }
}
