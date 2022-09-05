<?php

namespace LaraZeus\Sky\Http\Livewire;

use Illuminate\Database\Eloquent\Collection;

trait SearchHelpers
{
    private function highlightSearchResults(Collection $posts, ?string $search = null): Collection
    {
        if (!$search) {
            return $posts;
        }

        foreach ($posts as $i => $post) {
            $posts[$i]->title = $this->parsing($post->title, [$search]);
            $posts[$i]->content = $this->parsing($post->content, [$search]);
            $posts[$i]->description = $this->parsing($post->description, [$search]);
        }

        return $posts;
    }

    /**
     * Credits for this code goes to link below.
     *
     * @link https://stackoverflow.com/questions/8564578/php-search-text-highlight-function
     */
    public function parsing(string $inp, array $words): string
    {
        $class = config('zeus-sky.search_result_highlight_css_class', 'highlight');
        $replace = array_flip(array_flip($words));
        $pattern = [];

        foreach ($replace as $k => $fword) {
            $pattern[] = '/\b(' . $fword . ')(?!>)\b/i';
            $replace[$k] = sprintf('<span class="%s">$1</span>', $class);
        }

        return preg_replace($pattern, $replace, $inp);
    }
}
