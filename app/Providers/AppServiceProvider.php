<?php

namespace App\Providers;

use App\Models\NormalUser;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
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
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('components.frontend.navbar', function ($view) {
            $normalUser = null;
            $normalUserId = Session::get('normal_user_id');

            if ($normalUserId) {
                $normalUser = NormalUser::find($normalUserId);

                if (!$normalUser) {
                    Session::forget('normal_user_id');
                }
            }

            $view->with('normalUserSession', $normalUser);
        });
    }
}
