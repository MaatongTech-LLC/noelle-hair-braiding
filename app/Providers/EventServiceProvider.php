<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CartController;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            \App\Listeners\MergeGuestCart::class,
        ],
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
