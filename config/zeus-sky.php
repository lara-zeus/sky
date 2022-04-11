<?php

return [
    /**
     * set the default path for the blogs homepage
     */
    'path' => 'blog',

    'middleware' => ['web'],

    'site_title' => config('app.name', 'Laravel').' | '.'Blogs',

    'site_description' => 'All about '.config('app.name', 'Laravel').' Blogs',

    'site_color' => '#F5F5F4',

    'layout' => 'zeus::components.app',

    'theme' => 'zeus',

    'translatable_Locales' => ['en','ar'],
];
