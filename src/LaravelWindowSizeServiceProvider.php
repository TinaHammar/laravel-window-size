<?php

namespace Tanthammar\LaravelWindowSize;

include_once('Helpers.php');

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class LaravelWindowSizeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/breakpoints.php', 'breakpoints');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/breakpoints.php' => config_path('breakpoints.php')], 'laravel-window-size');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/', 'window-size');
        $this->bladeDirectives();
    }

    protected function bladeDirectives()
    {
        Blade::if('windowWidthLessThan', function ($value) {
            return windowWidthLessThan($value);
        });

        Blade::if('windowWidthGreaterThan', function ($value) {
            return windowWidthGreaterThan($value);
        });

        Blade::if('windowWidthBetween', function ($expression) {
            return windowWidthBetween($expression);
        });

        Blade::if('windowHeightLessThan', function ($value) {
            return windowHeightLessThan($value);
        });

        Blade::if('windowHeightGreaterThan', function ($value) {
            return windowHeightGreaterThan($value);
        });

        Blade::if('windowHeightBetween', function ($expression) {
            return windowHeightBetween($expression);
        });

        Blade::if('windowXs', function () {
            return windowXs();
        });

        Blade::if('windowSm', function () {
            return windowSm();
        });

        Blade::if('windowMd', function () {
            return windowMd();
        });

        Blade::if('windowLg', function () {
            return windowLg();
        });

        Blade::if('windowXl', function () {
            return windowXl();
        });

        Blade::if('window2xl', function () {
            return window2xl();
        });
    }
}
