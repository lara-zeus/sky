<?php

namespace LaraZeus\Sky\Classes\LinkRenderers;

use Illuminate\Database\Eloquent\Model;
use LaraZeus\Sky\Models\Library;
use LaraZeus\Sky\SkyPlugin;

class LibraryLinkRenderer extends NavLinkRenderer
{
    public static string $rendersKey = 'library-link';

    public function getModel(): ?Model
    {
        return SkyPlugin::get()->getModel('Tag')::find($this->item['data']['library_id']);
    }

    public function getLink(): ?string
    {
        /**
         * @var Library $tag
         */
        $tag = $this->getModel();

        return route('library.tag', $tag->slug);
    }

    public function isActiveRoute(): bool
    {
        /**
         * @var Library $tag
         */
        $tag = $this->getModel();

        return str(request()->url())->contains($tag->library->first()->slug);
    }
}
