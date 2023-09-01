<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chap;
use App\Models\Chap_noi_dung;
use Illuminate\Support\Facades\DB;

class ChapController extends Controller
{
    public function themChap(Request $r, $id)
    {
        $chap = Chap::create(
            [
                'ten_chap' => $r->name,
                'id_truyen' => $id,
                'ngay_dang' => date('Y-m-d')
            ]
        );

        return response()->json(
            [
                'status' => 200,
                'mes' => 'Thành công'
            ]
        );
    }

    public function themImage(Request $r, $id)
    {
        if ($r->ajax()) {
            if ($r->file) {
                $img_name = $r->file->getClientOriginalName();
                $r->file->move(public_path('truyen_ND'), $img_name);
            }
        }
        Chap_noi_dung::create(
            [
                'id_chap' => $id,
                'noi_dung' => $img_name
            ]
        );

    }

    public function chapND($id)
    {
        $chap = DB::table('truyen')
            ->join('chap', 'truyen.id', '=', 'chap.id_truyen')
            ->where('chap.id', $id)
            ->select('truyen.ten_truyen', 'chap.id', 'chap.ten_chap', 'chap.id_truyen')->get();
        return view('AdminPage/noi-dung-truyen', compact('chap'));
    }

    public function reviewImage($id)
    {
        $img = Chap_noi_dung::where('id_chap', $id)->get();
     
        $output = '<div class="row">';
        foreach ($img as $i) {
            $output .= '
            <div class="col-md-2">
                <img src="http://127.0.0.1:8000/truyen_ND/'. $i->noi_dung .'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <button type="button" class="btn btn-link remove_image" value="'. $i->id .'">Remove</button>
            </div>';
        }
        $output .= '</div>';

        return response()->json(
            [
                'img' => $output
            ]
        );
    }

    public function removeImage($id)
    {
        $img = Product_Img::where('id', $id)->first();
        $img->delete();
        return response()->json(
            [
                'message' => 'Suucess'
            ]
        );
    }

    public function reviewChap($id)
    {
        $img = Chap_noi_dung::where('id_chap', $id)->get();
        $title = DB::table('truyen')
            ->join('chap', 'truyen.id', '=', 'chap.id_truyen')
            ->where('chap.id', $id)
            ->select('truyen.ten_truyen', 'chap.ten_chap')
            ->groupBy('truyen.ten_truyen', 'chap.ten_chap')->get();
        return view('AdminPage/review-chap', compact('img', 'title'));
    }


    public function chapChu($id)
    {
        $chap =  DB::table('truyen')
            ->join('chap', 'truyen.id', '=', 'chap.id_truyen')
            ->where('chap.id', $id)
            ->select('truyen.ten_truyen', 'chap.id', 'chap.ten_chap', 'chap.id_truyen')->get();
        return view('AdminPage/ND_truyen_chu', compact('chap'));
    }

    public function themND(Request $r, $id)
    {
        Chap_noi_dung::create(
            [
                'id_chap' => $id,
                'noi_dung' => $r->nameChap
            ]
        );

        return response()->json(
            [
                'message' => 'Thêm nội dung thành công'
            ]
        );
    }

    public function reviewChapChu($id)
    {
        $noidung = Chap_noi_dung::where('id_chap', $id)->get();
        $title = DB::table('truyen')
            ->join('chap', 'truyen.id', '=', 'chap.id_truyen')
            ->where('chap.id', $id)
            ->select('truyen.ten_truyen', 'chap.ten_chap')
            ->groupBy('truyen.ten_truyen', 'chap.ten_chap')->get();
        return view('AdminPage/review-chap-chu', compact('noidung', 'title'));
    }
}
