<?php

namespace EasyShop\Providers;

use Illuminate\Support\ServiceProvider;
use EasyShop\Model\Product;
use EasyShop\Model\ProductMovement;
use EasyShop\Model\Trade;
use EasyShop\Observers\CreatedByObserver;
use EasyShop\Observers\ProductMovementObserver;

class DatabaseEventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Trade::observe(CreatedByObserver::class);
        Product::observe(CreatedByObserver::class);
        ProductMovement::observe(CreatedByObserver::class);
        ProductMovement::observe(ProductMovementObserver::class);
    }
}
