<?php

namespace App\Providers;

use app\Interfaces\TeacherRepositoryInterface\TeacherRepositoryInterface;
use App\Repositories\TeacherRepository\TeacherRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TeacherRepositoryInterface::class , TeacherRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
