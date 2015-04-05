<?php
namespace Caouecs\Bootstrap3;

use Illuminate\Support\ServiceProvider;
use View;

class Bootstrap3ServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->package('caouecs/bootstrap3');

        View::addNamespace('bootstrap3', __DIR__.'/../../views/');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
