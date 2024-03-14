<?php

namespace LaraZeus\Sky\Classes\LinkRenderers;

use Illuminate\Database\Eloquent\Model;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\SkyPlugin;

class PostLinkRenderer extends NavLinkRenderer
{
    public static string $renders = 'post-link';

    public function getModel(): ?Model
    {
        return SkyPlugin::get()->getModel('Post')
            ::whereDate('published_at', '<=', now())
            ->find($this->item['data']['post_id']);
    }

    public function getLink(): ?string
    {
        /**
         * @var Post $post
         */
        $post = $this->getModel();
        return route('post', $post);
    }

    public function isActiveRoute(): bool
    {
        /**
         * @var Post $post
         */
        $post = $this->getModel();
        return request()->routeIs('post', $post);
    }
}
