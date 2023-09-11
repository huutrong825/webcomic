<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\The_loai;
use Yajra\Datatables\Datatables;

class TheLoaiController extends Controller
{
    // Hàm thêm thể loại mới
    public function themTheLoai(Request $rq)
    {
        $rq->validate(
            [
                'theloai' => 'required|',
            ]
        );

        $p = The_loai::create(
            [
                'the_loai' => $rq->theloai,
            ]
        );

        return response()->json(
            [
                'state' => 200,
                'mes' => 'Thêm thành công',
            ]
        );        
    }

    public function theLoai()
    {
        $TL = The_loai::all();

        return Datatables::of($TL)
            ->addColumn(
                'action', function ($TL) {
                    return '<a value="' . $TL->id .'" class="btn btn-success btn-circle btn-sm bt-Update-TL">
                    <i class="fas fa-pen"></i></a>            

                    <a value="' . $TL->id .'" class="btn btn-danger btn-circle btn-sm bt-Delete-TL">
                    <i class="fas fa-trash"></i></a>';
                }
            )
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getID($id)
    {
        $item = The_loai::where('id', $id)->first();
        return response()->json(
            [
                'state' => 200,
                'item' => $item,
            ]
        );
    }

    public function update(Request $r, $id)
    {
        $item = The_loai::where('id', $id)->first();
        $item->update(
            [
                'the_loai' => $r->theloai,
            ]
        );

        return response()->json(
            [
                'status' => 200,
                'mes' => 'Thành công'
            ]
        );
    }

    public function delete($id)
    {
        $theloai = The_loai::where('id', $id)->first();

        if ($theloai) {

            $theloai->delete();

            return response()->json(
                [
                    'message' => "Xóa thể loại thành công"
                ]
            );
            
        } else {
            return response()->json(['errors' => 'Không tìm thấy thể loại trong dữ liệu']);
        }
    }
}
