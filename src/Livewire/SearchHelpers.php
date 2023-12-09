<?php

namespace LaraZeus\Sky\Livewire;

use Illuminate\Database\Eloquent\Collection;

trait SearchHelpers
{
    private function highlightSearchResults(Collection $collection, ?string $search = null): Collection
    {
        if (! $search) {
            return $collection;
        }

        /**
         * @var \LaraZeus\Sky\Models\Post $item
         */
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
    public function parsing(string $content, array $words): string
    {
        // Skip highlighting of search terms when specific tags e.g.
        // <iframe> exists in the content so no html breaks:
        foreach (config('zeus-sky.skipHighlightingTerms') as $skipper) {
            if (str_contains($content, $skipper)) {
                return $content;
            }
        }

        $replace = array_flip(array_flip($words));
        $pattern = [];

        foreach ($replace as $k => $fword) {
            $pattern[] = '/\b(' . $fword . ')(?!>)\b/i';
            $replace[$k] = sprintf('<span class="%s">$1</span>', config('zeus-sky.searchResultHighlightCssClass'));
        }

        return preg_replace($pattern, $replace, $content);
    }
}
