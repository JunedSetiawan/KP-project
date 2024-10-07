<?php

namespace App\Providers;

use App\Models\User;
use App\Services\FonnteService;
use App\Tables\ListLogAttendances;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use ProtoneMedia\Splade\Facades\SEO;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FonnteService::class, function ($app) {
            return new FonnteService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        SEO::metaByName('theme-color', '#D926A9');

        // permission for view Apps
        Gate::define('view-inventory', function (User $user) {
            return $user->isSuperAdmin() || $user->isManager();
        });
        Gate::define('view-sales', function (User $user) {
            return $user->isSuperAdmin() || $user->isSales() || $user->isManager();
        });
        Gate::define('view-purchase', function (User $user) {
            return $user->isSuperAdmin() || $user->isPurchase() || $user->isManager();
        });
        Gate::define('view-user', function (User $user) {
            return $user->isSuperAdmin() || $user->isManager();
        });

        // permission for view history
        Gate::define('view-sales-history', function (User $user) {
            return $user->isSales();
        });
        Gate::define('view-purchase-history', function (User $user) {
            return $user->isPurchase();
        });

        // Permission for manage Apps

        Gate::define('manage-year', function (User $user) {
            return $user->isAdmin() || $user->isUser();
        });
        Gate::define('manage-student', function (User $user) {
            return $user->isAdmin() || $user->isUser();
        });
        Gate::define('manage-class', function (User $user) {
            return $user->isAdmin() || $user->isUser();
        });
        Gate::define('manage-teacher', function (User $user) {
            return $user->isAdmin() || $user->isUser();
        });
        Gate::define('manage-user', function (User $user) {
            return $user->isAdmin();
        });

    }
}
