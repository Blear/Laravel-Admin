<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2017/2/20
 * Time: 13:48
 */

namespace App\Services\Access\Facades;


use Illuminate\Support\Facades\Facade;

class Access extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'access';
    }
}