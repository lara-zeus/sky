<?php

namespace LaraZeus\Sky\Classes;

use Illuminate\Support\Facades\Blade;
use LaraZeus\Sky\Classes\LinkRenderers\GenericLinkRenderer;
use LaraZeus\Sky\Classes\LinkRenderers\LibraryLinkRenderer;
use LaraZeus\Sky\Classes\LinkRenderers\NavLinkRenderer;
use LaraZeus\Sky\Classes\LinkRenderers\PageLinkRenderer;
use LaraZeus\Sky\Classes\LinkRenderers\PostLinkRenderer;
use LaraZeus\Sky\SkyPlugin;

class RenderNavItem
{
    /**
     * @var class-string<NavLinkRenderer>
     */
    public static string $defaultRendererClass = GenericLinkRenderer::class;

    /**
     * Set the default active CSS class(es) on a nav link.
     *
     * @return $this
     */
    public static function setActiveClasses(string $activeClasses): void
    {
        NavLinkRenderer::$activeClasses = $activeClasses;
    }

    /**
     * Set the default non-active CSS class(es) on a nav link.
     *
     * @return $this
     */
    public static function setNonActiveClasses(string $nonActiveClass): void
    {
        NavLinkRenderer::$nonActiveClasses = $nonActiveClass;
    }

    public static function getNavRenderers(): array
    {
        $allRenderers = array_merge([
            PageLinkRenderer::$rendersKey => PageLinkRenderer::class,
            PostLinkRenderer::$rendersKey => PostLinkRenderer::class,
            LibraryLinkRenderer::$rendersKey => LibraryLinkRenderer::class,
        ], config('zeus-sky.navRenderers', []));

        $renderersMap = [];
        foreach ($allRenderers as $renderer) {
            /**
             * @var NavLinkRenderer $renderer
             */
            $renderersMap[$renderer::$rendersKey] = $renderer;
        }

        return $renderersMap;
    }

    public static function render(array $item, string $class = ''): string
    {
        $itemType = $item['type'];
        if (str($itemType)->contains('_')) {
            $itemType = str($itemType)->replace('_', '-')->toString();
        }
        $renderersMap = static::getNavRenderers();
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
