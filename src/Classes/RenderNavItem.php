<?php

namespace LaraZeus\Sky\Classes;

use LaraZeus\Sky\Classes\LinkRenderers\GenericLinkRenderer;
use LaraZeus\Sky\Classes\LinkRenderers\NavLinkRenderer;
use LaraZeus\Sky\SkyPlugin;

class RenderNavItem
{
    /**
     * @var class-string<NavLinkRenderer>
     */
    public static string $defaultRendererClass = GenericLinkRenderer::class;

    private static function anchorLink(
        string $classes,
        string $target,
        string $link,
        string $label,
        bool $wrap = false,
        string $wrapClass = '',
    ): string {
        // TODO: make this component based?
        // Then it's probably easier for users to further customize this?
        return '<a class="' . $classes . '"
                    target="' . $target . '"
                    href="' . $link . '"
                >' .
            $label . // TODO: allow optional wrapping link text in span?
            // Or maybe support this customization via components?
            '</a>';
    }

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
        return static::anchorLink(...$renderer->getPreparedLink($class));
    }
}
