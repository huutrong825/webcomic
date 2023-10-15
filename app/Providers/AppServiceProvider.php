<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\The_loai;
use App\Models\Loai_truyen;
use App\Models\Store_truyen;
use App\Models\Banner;
use App\Models\Info_page;
use Illuminate\Support\Facades\Auth;
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

        $banners = Banner::all();
        $min = Banner::where('loai_banner', 1)->orderBy('id')->first();
        View::share('banners', $banners);
        View::share('min', $min);

        
        $checkstores = Store_truyen::all();
        View::share('checkstores', $checkstores);

        $infopage = Info_page::all();
        View::share('infopage', $infopage );

        Paginator::useBootstrap();
    }
}
