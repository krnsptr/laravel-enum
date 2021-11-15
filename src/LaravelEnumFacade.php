<?php

namespace Krnsptr\LaravelEnum;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Krnsptr\LaravelEnum\Skeleton\SkeletonClass
 */
class LaravelEnumFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-enum';
    }
}
