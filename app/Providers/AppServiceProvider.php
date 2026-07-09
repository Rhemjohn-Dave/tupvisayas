<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\CollegePage;

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
        Paginator::defaultView('pagination.public');
        Paginator::defaultSimpleView('pagination.admin-simple');

        View::composer('layouts.app', function ($view) {
            $view->with('navbarCollegePages', CollegePage::orderBy('college')->get());
        });
    }
}
