<?php

namespace LaraZeus\Sky\Classes\LinkRenderers;

use Illuminate\Database\Eloquent\Model;

class GenericLinkRenderer extends NavLinkRenderer
{

    public function getModel(): ?Model
    {
        return null;
    }

    public function getLink(): ?string
    {
        return $this->item['data']['url'];
    }

    public function isActiveRoute(): bool
    {
        return false;
    }
}
