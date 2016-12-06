<?php

namespace EasyShop\Providers;

use Illuminate\Support\ServiceProvider;

class DatabaseEventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \EasyShop\Model\Product::observe(\EasyShop\Observers\CreatedByObserver::class);
        \EasyShop\Model\ProductMovement::observe(\EasyShop\Observers\CreatedByObserver::class);
        \EasyShop\Model\ProductMovement::observe(\EasyShop\Observers\ProductMovementObserver::class);
    }
}
