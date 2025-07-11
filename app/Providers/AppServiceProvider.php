<?php

namespace App\Providers;

use App\Models\header;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;
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
    public function boot()
    {
        View::composer('*', function ($view) {
            $header = header::first();
            if ($header) {
                $header->encrypted_id = Crypt::encrypt($header->id);
            }

            $view->with('header', $header);
        });
    }
}
