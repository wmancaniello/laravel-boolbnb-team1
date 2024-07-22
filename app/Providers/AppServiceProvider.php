<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Iniettiamo il Braintree, usando Singleton, permette di creare da una classe una sola Istanza, e il figlio nato può accedere a tutto
        
        /* $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                [
                    // Chiavi per Braintree
                    'environment' => 'sandbox',
                    'merchantId' => 'zyhjkqfp8xpzwjrf',
                    'publicKey' => 'xdyjf5zpgfy5fv43',
                    'privateKey' => 'd8e56aef3bd531b1f71d63be20482f34'
                ]
            );
        }); */
    }}
