<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Truyen;
use App\Models\Info_page;
use Illuminate\Support\Facades\Validator;

class InfoPageController extends Controller
{
    public function tongQuan()
    {
        $banner = Banner::all();
        $info = Info_page::all();
        $truyen = Truyen::all();

        return view('AdminPage.Thong-tin', compact('banner', 'info', 'truyen'));
    }

    public function getTruyen($id)
    {
        $truyen = Truyen::where('id', $id)->first();
        return response()->json(
            [
                'items' => $truyen
            ]
        );
    }

   public function createBanner(Request $r)
   {
        try {
            $messages = [
                'product_select.required' => 'Buộc phải chọn truyện',
                'type_banner.required' => 'Buộc phải chọn loại banner',
            ];

            $v = Validator::make(
                $r->all(),
                [
                    'product_select' => 'required',
                    'type_banner' => 'required',

                ], $messages
            );

            if ($v->fails()) {
                return response()->json(['errors' => $v->errors()], 422);
            } else {

                $banner = Banner::where('id_truyen', $r->product_select)
                    ->where('loai_banner', $r->type_banner)->first();

                $truyen = Truyen::where('id', $r->product_select)->first();

                if ($banner) {
                    return response()->json(['errors' => "Banner này đã tồn tại"]);
                } else {

                    Banner::create(
                        [
                            'id_truyen' => $truyen->id,
                            'image' => $truyen->bia_truyen,
                            'ten_truyen' => $truyen->ten_truyen,
                            'loai_banner' => $r->type_banner
                        ]
                    );

                    return response()->json(
                        [
                            'message' => "Thêm banner thành công"
                        ]
                    );
                }
            }
        } catch (Exception $e)
        {
            return back()->withError($e.getMessage());
        }
    }

}
