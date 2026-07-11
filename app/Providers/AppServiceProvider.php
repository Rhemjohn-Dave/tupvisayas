<?php

namespace App\Providers;

use App\Models\CollegePage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::defaultView('pagination.public');
        Paginator::defaultSimpleView('pagination.admin-simple');

        View::composer('layouts.app', function ($view) {
            $view->with(
                'navbarCollegePages',
                Cache::remember('navbar.college_pages', now()->addHours(6), function () {
                    return CollegePage::query()
                        ->orderBy('college')
                        ->get(['id', 'college']);
                })
            );
        });
    }
}
