<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loai_truyen;
use Yajra\Datatables\Datatables;

class LoaiTruyenController extends Controller
{
    public function themLoai(Request $rq)
    {
        $rq->validate(
            [
                'loai' => 'required|',
            ]
        );

        $p = Loai_truyen::create(
            [
                'loai_truyen' => $rq->loai,
            ]
        );

        return response()->json(
            [
                'state' => 200,
                'mes' => 'Thêm thành công',
            ]
        );        
    }

    public function Loai()
    {
        $LT = Loai_truyen::all();

        return Datatables::of($LT)
            ->addColumn(
                'action', function ($LT) {
                    return '<a value="' . $LT->id .'" class="btn btn-success btn-circle btn-sm bt-Update-Loai">
                    <i class="fas fa-pen"></i></a>            

                    <a value="' . $LT->id .'" class="btn btn-danger btn-circle btn-sm bt-Delete-Loai">
                    <i class="fas fa-trash"></i></a>';
                }
            )
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getID($id)
    {
        $item = Loai_truyen::where('id', $id)->first();
        return response()->json(
            [
                'state' => 200,
                'item' => $item,
            ]
        );
    }

    public function update(Request $r, $id)
    {
        $item = Loai_truyen::where('id', $id)->first();
        $item->update(
            [
                'loai_truyen' => $r->theloai,
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
        $loai = Loai_truyen::where('id', $id)->first();

        if ($loai) {

            $loai->delete();

            return response()->json(
                [
                    'message' => "Xóa loại truyện thành công"
                ]
            );
            
        } else {
            return response()->json(['errors' => 'Không tìm thấy loại truyện trong dữ liệu']);
        }
    }
}
