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
        Gate::define('manage-classic-service', function (User $user) {
            return $user->isAdmin() || $user->isUser();
        });
        Gate::define('manage-individual-service', function (User $user) {
            return $user->isAdmin() || $user->isUser();
        });
    }
}
