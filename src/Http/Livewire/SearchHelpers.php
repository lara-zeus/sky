<?php

namespace LaraZeus\Sky\Http\Livewire;

use Illuminate\Database\Eloquent\Collection;

trait SearchHelpers
{
    private function highlightSearchResults(Collection $collection, ?string $search = null): Collection
    {
        if (! $search) {
            return $collection;
        }

        foreach ($collection as $item) {
            $item->title = $this->parsing($item->title, [$search]);
            $item->content = $this->parsing($item->content, [$search]);
            $item->description = $this->parsing($item->description, [$search]);
        }

        return $collection;
    }

    /**
     * Credits for this code goes to link below.
     *
     * @link https://stackoverflow.com/questions/8564578/php-search-text-highlight-function
     */
    public function parsing(string $attribute, array $words): string
    {
        $class = config('zeus-sky.search_result_highlight_css_class', 'highlight');
        $replace = array_flip(array_flip($words));
        $pattern = [];

        foreach ($replace as $k => $fword) {
            $pattern[] = '/\b('.$fword.')(?!>)\b/i';
            $replace[$k] = sprintf('<span class="%s">$1</span>', $class);
        }

        return preg_replace($pattern, $replace, $attribute);
    }
}
