<?php

namespace LaraZeus\Sky\Classes;

use Illuminate\Support\Facades\Blade;
use LaraZeus\Sky\Classes\LinkRenderers\GenericLinkRenderer;
use LaraZeus\Sky\Classes\LinkRenderers\NavLinkRenderer;
use LaraZeus\Sky\SkyPlugin;

class RenderNavItem
{
    /**
     * @var class-string<NavLinkRenderer>
     */
    public static string $defaultRendererClass = GenericLinkRenderer::class;

    public static function render(array $item, string $class = ''): string
    {
        $itemType = $item['type'];
        if (str($itemType)->contains('_')) {
            $itemType = str($itemType)->replace('_', '-')->toString();
        }
        $renderersMap = SkyPlugin::get()->getNavRenderers();
        if (array_key_exists($itemType, $renderersMap)) {
            $rendererClass = $renderersMap[$itemType];
            $renderer = new $rendererClass($item);
        } else {
            $renderer = new static::$defaultRendererClass($item);
        }

        /**
         * @var NavLinkRenderer $renderer
         */
        return Blade::render(
            '<x-zeus::sky-link :class="$class" :target="$target" :href="$href" :label="$label"  />',
            $renderer->getPreparedLink($class)
        );
    }
}
