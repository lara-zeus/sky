<?php

namespace LaraZeus\Sky\Classes\LinkRenderers;

use Illuminate\Database\Eloquent\Model;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\SkyPlugin;

class PageLinkRenderer extends NavLinkRenderer
{
    public static string $renders = 'page-link';

    public function getModel(): ?Model
    {
        return SkyPlugin::get()->getModel('Post')::page()
                    ->whereDate('published_at', '<=', now())
                    ->find($this->item['data']['page_id']);
    }

    public function getLink(): ?string
    {
        /**
         * @var Post $page
         */
        $page = $this->getModel();
        return route('page', $page);
    }

    public function isActiveRoute(): bool
    {
        /**
         * @var Post $page
         */
        $page = $this->getModel();
        return request()->routeIs('page', $page);
    }
}
