<?php

namespace LaraZeus\Sky;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaraZeus\Sky\Skeleton\SkeletonClass
 */
class SkyFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sky';
    }
}