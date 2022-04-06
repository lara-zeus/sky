<?php

return [
    'prefix' => '/',

    'path' => 'blog',

    'layout' => 'zeus::components.layouts.app',

    'middleware' => ['web'],

    'site_title' => config('app.name', 'Laravel').' | '.'Blogs',

    'site_description' => 'All about '.config('app.name', 'Laravel').' Blogs',

    'site_color' => '#F5F5F4',
];
