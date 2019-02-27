<?php

namespace Industrious\Flash;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Contracts\Session\Session;
use Industrious\Flash\Composers;

class FlashServiceProvider extends ServiceProvider
{
    /** @var array */
    protected $composers = [
        Composers\FlashComposer::class => 'industrious-flash::flash-messages',
    ];

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'industrious-flash');

        $view = $this->app['view'];

        foreach ($this->composers as $composer => $views) {
            $view->composer($views, $composer);
        }
    }

    public function register()
    {
        foreach ($this->composers as $composer => $views) {
            $this->app->singleton($composer, function ($app) use ($composer) {
                return $app->build($composer);
            });
        }

        $this->app->singleton(Flash::class, function ($app) {
            $session = $app[Session::class];
            $flash = new Flash($session);
            $app['events']->listen(RequestHandled::class, function () use ($flash) {
                $flash->flash();
            });
            return $flash;
        });
    }
}
