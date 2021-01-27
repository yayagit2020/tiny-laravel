<?php
namespace Yaya\TinyLaravel\Support\Facades;

use Yaya\TinyLaravel\Support\Facades\Facade;

/**
* 
*/
class DB extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'orcale';
    }
}