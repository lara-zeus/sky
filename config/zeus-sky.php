<?php

return [
    'prefix' => 'sky',
    'middleware' => ['web'],
    'uriPrefix' => [
        'post' => 'post',
        'page' => 'page',
        'library' => 'library',
        'faq' => 'faq',
    ],
    'enabledResources' => [
        'PostResource',
        'PageResource',
        'FaqResource',
        'LibraryResource',
    ],
    'parsers' => [
        \LaraZeus\Sky\Classes\BoltParser::class,
    ],
    'recentPostsLimit' => 5,
    'searchResultHighlightCssClass' => 'highlight',
    'skipHighlightingTerms' => ['iframe'],
    'defaultFeaturedImage' => null,

];
