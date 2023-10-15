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
    //Trang thông tin
    public function tongQuan()
    {
        
        $truyen = Truyen::all();

        return view('AdminPage.Thong-tin', compact('truyen'));
    }
    //Lấy truyện
    public function getTruyen($id)
    {
        $truyen = Truyen::where('id', $id)->first();
        return response()->json(
            [
                'items' => $truyen
            ]
        );
    }
    //Tạo banner
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
    //Hiển thị banner
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
                    return '<a value="' . $banner->id .'" class="btn btn-success btn-circle btn-sm bt_updateBanner">
                    <i class="fas fa-pen"></i></a>            

                    <a value="' . $banner->id .'" class="btn btn-danger btn-circle btn-sm bt_deleteBanner">
                    <i class="fas fa-trash"></i></a>';
                }
            )
            ->rawColumns(['image', 'loai_banner', 'action'])
            ->make(true);
    }
    //Lấy banner
    public function getBanner($id)
    {
        $banner = Banner::where('id', $id)->first();
        return response()->json(
            [
                'items' => $banner
            ]
        );
    }
    // Cập nhật banner
    public function updateBanner(Request $r, $id)
    {
        try {
            $banner = Banner::where('id', $id)->first();
            if ($banner) {

                $truyen = Truyen::where('id', $r->product_up_select)->first();

                $banner->update(
                    [
                        'id_truyen' => $truyen->id,
                        'image' => $truyen->bia_truyen,
                        'ten_truyen' => $truyen->ten_truyen,
                        'loai_banner' => $r->type_up_banner
                    ]
                );
    
                return response()->json(
                    [
                        'message' => "Cập nhật banner thành công"
                    ]
                );
                
            } else {
                return response()->json(['errors' => 'Không tìm thấy banner trong dữ liệu']);
            }
        } catch (Exception $e) {
            return back()->withError($e.getMessage());
        }
    }
    // Xóa banner
    public function deleteBanner($id)
    {
        try {
            
            $banner = Banner::where('id', $id)->first();
            if ($banner) {

                $banner->delete();
    
                return response()->json(
                    [
                        'message' => "Xóa banner thành công"
                    ]
                );
                
            } else {
                return response()->json(['errors' => 'Không tìm thấy banner trong dữ liệu']);
            }
        } catch (Exception $e) {
            return back()->withError($e.getMessage());
        }
    }
    //Hiển thị info
    public function info()
    {
        $info = Info_page::all();

        return Datatables::of($info)->make(true);
    }
    // Lấy info
    public function getInfo()
    {
        $info = Info_page::where('id', 1)->first();
        return response()->json(
            [
                'items' => $info
            ]
        );
    }
    //CẬp nhật info
    public function updateInfo(Request $r)
    {
        try {
            $info = Info_page::findOrFail(1);

            if ($info) {
                $info->update(
                    [
                        'email' => $r->email,
                        'phone' => $r->phone,
                        'ten_web' => $r->ten_web,
                        'tieu_de' => $r->tieu_de
                    ]
                );
                return response()->json(
                    [
                        'message' => "Cập nhật thông tin thành công"
                    ]
                );
            } else {
                return response()->json(['errors' => 'Không tìm thấy thông tin cập nhật']);
            }
        } catch (Exception $e) {
            return back()->withError($e.getMessage());
        }
    }

}
