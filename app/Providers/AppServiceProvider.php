<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\The_loai;
use App\Models\Loai_truyen;
use Illuminate\Pagination\Paginator;

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
        $loai = Loai_truyen::all();
        View::share('loai', $loai);

        $theloai = The_loai::all();
        View::share('theloai', $theloai);

        Paginator::useBootstrap();
    }
}
