<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Info_page;

class InfoPageController extends Controller
{
    public function tongQuan()
    {
        $banner = Banner::all();
        $info = Info_page::all();

        return view('AdminPage.Thong-tin', compact('banner', 'info'));
    }

   
}
