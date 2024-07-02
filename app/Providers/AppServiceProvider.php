<?php

namespace App\Providers;

use App\Repositories\AppointmentRepository;
use App\Repositories\AppointmentRepositoryInterface;
use App\Repositories\ContentRepository;
use App\Repositories\ContentRepositoryInterface;
use App\Repositories\CouponRepository;
use App\Repositories\CouponRepositoryInterface;
use App\Repositories\DealerRepository;
use App\Repositories\DealerRepositoryInterface;
use App\Repositories\HolidaySetRepository;
use App\Repositories\HolidaySetRepositoryInterface;
use App\Repositories\LocationRepository;
use App\Repositories\LocationRepositoryInterface;
use App\Repositories\MarketRepository;
use App\Repositories\MarketRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CouponRepositoryInterface::class, CouponRepository::class);
        $this->app->bind(DealerRepositoryInterface::class, DealerRepository::class);
        $this->app->bind(MarketRepositoryInterface::class, MarketRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
        $this->app->bind(AppointmentRepositoryInterface::class, AppointmentRepository::class);
        $this->app->bind(HolidaySetRepositoryInterface::class, HolidaySetRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
