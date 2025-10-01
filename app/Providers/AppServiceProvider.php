<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        /**
         * Con questa riga di codice si cambia la visualizzazione dei link di paginazione. Nel caso specifico,
         * selezioniamo la visualizzazione Bootstrap 5.
         */
        Paginator::useBootstrapFive();
    }
}
