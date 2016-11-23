<?php

namespace EasyShop\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CustomValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('time', function($attribute, $value, $parameters, $validator) {
            return date_parse_from_format('H:i', $value)['error_count'] == 0;
        });
        /*
        $parameters[0] = 'ModelName'
        How to use: 'id:ModelName'
        */
        Validator::extend('id', function($attribute, $value, $parameters, $validator) {
            return $value > 0 &&
                (config('app.name')."\Model\\$parameters[0]")::where('id','=',$value)->exists();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
