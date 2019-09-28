<?php
namespace Yjtec\Upload\Facades;
use Illuminate\Support\Facades\Facade;
/**
 * @see \Illuminate\View\Factory
 */
class Upload extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'upload';
    }
}