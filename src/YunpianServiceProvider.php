<?php
/**
 *
 * Author: lifuren <frenlee@163.com>
 * Since: 16/9/10 23:58
 */

namespace Skyling\Yunpian;


use Illuminate\Support\ServiceProvider;

class YunpianServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton('yunpian', function ($app) {
            return new Yunpian();
        });
    }
}