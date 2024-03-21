<?php

namespace LaraZeus\Sky\Classes\LinkRenderers;

use Illuminate\Database\Eloquent\Model;

abstract class NavLinkRenderer
{
    public static string $rendersKey;

    public function __construct(
        protected array $item
    ) {
    }

    public static string $activeClasses = 'border-b border-b-secondary-500 text-secondary-500';

    public static string $nonActiveClasses = 'border-transparent';

    abstract public function getModel(): ?Model;

    abstract public function getLink(): ?string;

    abstract public function isActiveRoute(): bool;

    public function getActiveClass(): string
    {
        return $this->isActiveRoute() ?
                self::$activeClasses :
                self::$nonActiveClasses;
    }

    /**
     * @return array{}
     */
    public function getPreparedLink(string $classes = ''): array
    {
        return [
            'class' => $classes . ' ' . $this->getActiveClass(),
            'target' => $this->item['data']['target'] ?? '_self',
            'href' => $this->getLink(),
            'label' => $this->item['label'],
        ];
    }
}
