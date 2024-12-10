<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Blade::component('dialogs.success', 'notification-success');
        Blade::component('dialogs.error', 'notification-error');
    }
}
