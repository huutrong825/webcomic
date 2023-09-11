<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Truyen;
use App\Models\Info_page;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class InfoPageController extends Controller
{
    public function tongQuan()
    {
        
        $truyen = Truyen::all();

        return view('AdminPage.Thong-tin', compact('truyen'));
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
        } catch (Exception $e) {
            return back()->withError($e.getMessage());
        }
    }

    public function banner()
    {
        $banner = Banner::all();

        return Datatables::of($banner)
            ->addColumn(
                'image', function ($banner) {
                    $url = asset('img_truyen/' . $banner->image);
                    return '<img src="'. $url .'" alt="Picture" style="width:50px;height:50px">';
                }
            )
            ->addColumn(
                'loai_banner', function ($banner) {
                    $temp = $banner->loai_banner == 1 ? '<td><span style="color:red">Banner carousel</span></td>'
                        : ($banner->loai_banner == 2 ? '<td><span style="color:blue">Banner offer</span></td>'
                        : '<td><span style="color:green">Banner item</span></td>');
                    return $temp;
                }
            )
            ->addColumn(
                'action', function ($banner ) {
                    return '<a value="' . $banner->id .'" class="btn btn-success btn-circle btn-sm ">
                    <i class="fas fa-pen"></i></a>            

                    <a value="' . $banner->id .'" class="btn btn-danger btn-circle btn-sm">
                    <i class="fas fa-trash"></i></a>';
                }
            )
            ->rawColumns(['image', 'loai_banner', 'action'])
            ->make(true);
    }

    public function info()
    {
        $info = Info_page::all();

        return Datatables::of($info)->make(true);
    }

    public function getInfo()
    {
        $info = Info_page::where('id', 1)->first();
        return response()->json(
            [
                'items' => $info
            ]
        );
    }

}
