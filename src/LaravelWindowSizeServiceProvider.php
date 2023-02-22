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

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/breakpoints.php', 'breakpoints');
    }

    public function boot(): void
    {
        $this->publishes([__DIR__ . '/../config/breakpoints.php' => config_path('breakpoints.php')], 'laravel-window-size');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/', 'window-size');
        $this->bladeDirectives();
    }

    protected function bladeDirectives(): void
    {
        Blade::if('windowWidthLessThan', static function ($value) {
            return windowWidthLessThan($value);
        });

        Blade::if('windowWidthGreaterThan', static function ($value) {
            return windowWidthGreaterThan($value);
        });

        Blade::if('windowWidthBetween', static function (...$expression) {
            return windowWidthBetween($expression);
        });

        Blade::if('windowHeightLessThan', static function ($value) {
            return windowHeightLessThan($value);
        });

        Blade::if('windowHeightGreaterThan', static function ($value) {
            return windowHeightGreaterThan($value);
        });

        Blade::if('windowHeightBetween', static function (...$expression) {
            return windowHeightBetween($expression);
        });

        Blade::if('windowXs', static fn () => windowXs());

        Blade::if('windowSm', static fn () => windowSm());

        Blade::if('windowMd', static fn () => windowMd());

        Blade::if('windowLg', static fn () => windowLg());

        Blade::if('windowXl', static fn () => windowXl());

        Blade::if('window2xl', static fn () => window2xl());
    }
}
