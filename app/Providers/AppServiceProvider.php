<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domains\Expenses\Payment\Repositories\PaymentRepository;
use App\Domains\Expenses\Payment\Services\PaymentService;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->singleton(PaymentRepository::class, function () {
            return new PaymentRepository;
        });

        $this->app->singleton(PaymentService::class, function ($app) {
            return new PaymentService($app->make(PaymentRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
        FilamentColor::register([
            'danger' => Color::Red,
            'gray' => Color::Zinc,
            'info' => Color::Blue,
            'primary' => Color::Teal,
            'success' => Color::Green,
            'warning' => Color::Amber,
        ]);
    }
}
