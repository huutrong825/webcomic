<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truyen;
use App\Models\Chap;
use App\Models\Truyen_Theloai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class TruyenController extends Controller
{
    public function themTruyen(Request $r) 
    {      
        
        $truyen = Truyen::create(
            [
                'ten_truyen' => $r->tentruyen,
                'tac_gia' => $r->tacgia,
                'nhom_dich' => $r->dich,
                'loai_truyen' => $r->loai,
                'trang_thai' => $r->trangthai,
                'mo_ta' => $r->mota,
                'bia_truyen' => $r->anh,
                'ngay_dang' => date('Y-m-d'),
            ]
        );

        $truyen->save();

        foreach ($r->theloai as $a) {
            $p = Truyen_Theloai::create(
                [
                    'id_truyen' => $truyen->id,
                    'id_theloai' => $a,
                ]
            );
        }

        return response()->json(
            [
                'state' => 200,
                'mes' => "Thêm thành công",
            ]
        );
    }

    public function truyenTranh() 
    {
        $truyen = DB::select(
            'select t.*, m.ten_chap
            FROM truyen t
            LEFT JOIN (SELECT * FROM  chap c JOIN (
                SELECT h.id_truyen as i, MAX(h.ngay_dang) as d
                FROM chap h
                GROUP BY h.id_truyen
                ) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang=latest_chap.d) as m ON t.id = m.id_truyen WHERE t.loai_truyen = 2' 
        );

        return view('AdminPage.truyen-tranh', compact('truyen'));
    }

    public function truyenChu() 
    {
        $truyen = DB::select(
            'select t.*, m.ten_chap
            FROM truyen t
            LEFT JOIN (SELECT * FROM  chap c JOIN (
                SELECT h.id_truyen as i, MAX(h.ngay_dang) as d
                FROM chap h
                GROUP BY h.id_truyen
                ) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang=latest_chap.d) as m ON t.id = m.id_truyen WHERE t.loai_truyen = 1' 
        );
        return view('AdminPage.truyen-chu', compact('truyen'));
    }

    public function detail($id) 
    {
        $truyen = Truyen::where('id', $id)->get();
        // dd($truyen);
        $TLoai= DB::table('theloai')
            ->join('truyen_theloai', 'theloai.id', '=', 'truyen_theloai.id_theloai')
            ->join('truyen', 'truyen.id', '=', 'truyen_theloai.id_truyen')
            ->where('truyen.id', $id)
            ->whereNull('truyen_theloai.deleted_at')
            ->select('theloai.the_loai', 'theloai.id')->get();
        $chap = DB::table('chap')
            ->join('truyen', 'truyen.id', '=', 'chap.id_truyen')
            ->where('truyen.id', $id)
            ->select('chap.*')->get();
        return view('AdminPage.chinh_sua_truyen', compact('truyen', 'TLoai', 'chap'));
    }

    public function updateTacgia(Request $req, $id)
    {
        try {

            $truyen = Truyen::findOrFail($id);

            if ($truyen) {

                $messages = [
                    'tacgia.min' => 'Tên dài hơn 1 ký tự',
                ];
    
                $v = Validator::make(
                    $req->all(),
                    [
                        'tacgia' => 'min:1',
                    ], $messages
                );
             
                if ($v->fails()) {
                    return response()->json(['errors' => $v->errors()], 422);
                } else {
                    $truyen->update(
                        [
                            'tac_gia' => $req->tacgia,
                        ]
                    );
                    return response()->json(
                        [
                            'message' => 'Cập nhật thành công'
                        ]
                    );
                }
            }
        } catch (Exception $e)
        {
            return back()->withError($e.getMessage());
        }
    }

    public function updateDich(Request $req, $id)
    {
        try {

            $truyen = Truyen::findOrFail($id);

            if ($truyen) {

                $messages = [
                    'nhomdich.min' => 'Tên dài hơn 1 ký tự',
                ];
    
                $v = Validator::make(
                    $req->all(),
                    [
                        'nhomdich' => 'min:1',
                    ], $messages
                );
             
                if ($v->fails()) {
                    return response()->json(['errors' => $v->errors()], 422);
                } else {
                    $truyen->update(
                        [
                            'nhom_dich' => $req->nhomdich,
                        ]
                    );
                    return response()->json(
                        [
                            'message' => 'Cập nhật thành công'
                        ]
                    );
                }
            }
        } catch (Exception $e)
        {
            return back()->withError($e.getMessage());
        }
    }

    public function updateMota(Request $req, $id)
    {
        try {

            $truyen = Truyen::findOrFail($id);

            if ($truyen) {
                $truyen->update(
                    [
                        'mo_ta' => $req->mota,
                    ]
                );
                return response()->json(
                    [
                        'message' => 'Cập nhật thành công'
                    ]
                );
            }
        } catch (Exception $e)
        {
            return back()->withError($e.getMessage());
        }
    }

    public function updateTheloai(Request $req, $id)
    {
        try {
            foreach ($req->theloai as $a) {
                $p = Truyen_Theloai::create(
                    [
                        'id_truyen' => $id,
                        'id_theloai' => $a,
                    ]
                );
            }
            return response()->json(
                [
                    'message' => 'Cập nhật thành công'
                ]
            );
        } catch (Exception $e)
        {
            return back()->withError($e.getMessage());
        }
    }

    public function deleteTheloai(Request $req, $id)
    {
        
        try {

            $t = Truyen_Theloai::where('id_truyen', $id)
                ->where('id_theloai', $req->theloai)->first();
                // dd($t);

            if ($t) {
            
                $t->delete();
                return response()->json(
                    [
                        'message' => 'Xóa thành công'
                    ]
                );
            } else {
                return response()->json(['errors' => "Không tìm thấy thể loại cần"]);
            }
        } catch (Exception $e)
        {
            return back()->withError($e.getMessage());
        }
    }

    public function updateAnhbia(Request $req, $id)
    {
        
        try {
            $truyen = Truyen::findOrFail($id);
            if ($truyen) {
                if ($req->file('input_av')) {
                  
                    $messages = [
                        'input_av.image' => 'Chỉ được phép nhập ảnh',
                        'input_av.mimes' => 'Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png .gif',
                    ];
        
                    $v = Validator::make(
                        $req->all(),
                        [
                            'input_av' => 'image|mimes:jpg,jpeg,png,gif',
        
                        ], $messages
                    );

                    if ($v->fails()) {
                        return response()->json(['errors' => $v->errors()], 422);
                    } else {

                        $img_name = '';
                        if ($req->file('input_av')->isValid()) {
                            $img = $req->input_av;
                            $img_name = $img->getClientOriginalName();
                            $img->move(public_path('img_truyen'), $img_name);  
                        }
                        $truyen->update(
                            [
                                'bia_truyen' => $img_name,
                            ]
                        );
                        return response()->json(
                            [
                                'message' => 'Cập nhật ảnh bìa thành công'
                            ]
                        );
                    }
                } else {
                    return response()->json(['errors' => "Cập nhật thất bại"]);
                }
            }
        } catch (Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()], 404);
        }
    }

    public function updateTrangthai(Request $req, $id)
    {
        try {

            $truyen = Truyen::findOrFail($id);

            if ($truyen) {
                $truyen->update(
                    [
                        'trang_thai' => $req->trangthai,
                    ]
                );
                return response()->json(
                    [
                        'message' => 'Cập nhật thành công'
                    ]
                );
            } else {
                return response()->json(['errors' => "Không tìm thấy truyện"]);
            }
        } catch (Exception $e)
        {
            return back()->withError($e.getMessage());
        }
    }
}
