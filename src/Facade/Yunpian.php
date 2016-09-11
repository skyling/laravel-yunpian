<?php
/**
 *
 * Author: lifuren <frenlee@163.com>
 * Since: 16/9/11 00:06
 */

namespace Skyling\Yunpian\Facade;


use Illuminate\Support\Facades\Facade;

class Yunpian extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'yunpian';
    }
}