<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truyen;
use App\Models\Chap;
use App\Models\The_loai;
use App\Models\Truyen_Theloai;
use App\Models\Chap_noi_dung;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function all()
    {
        $all = DB::table('truyen as t')
            ->leftJoin(DB::raw('(SELECT * FROM chap c JOIN (SELECT h.id_truyen as i, MAX(h.ngay_dang) as d FROM chap h GROUP BY h.id_truyen) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang = latest_chap.d) as m'), 't.id', '=', 'm.id_truyen')
            ->select('t.*', 'm.ten_chap')->paginate(12);

        $near = DB::table('truyen as t')
            ->leftJoin(DB::raw('(SELECT * FROM chap c JOIN (SELECT h.id_truyen as i, MAX(h.ngay_dang) as d FROM chap h GROUP BY h.id_truyen) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang = latest_chap.d) as m'), 't.id', '=', 'm.id_truyen')
            ->select('t.*', 'm.ten_chap')
            ->where('t.ngay_dang', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 1 MONTH)'))
            ->paginate(12);
        
        $update = DB::table('truyen as t')
            ->join(DB::raw('(SELECT * FROM chap c JOIN (SELECT h.id_truyen as i, MAX(h.ngay_dang) as d FROM chap h GROUP BY h.id_truyen) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang = latest_chap.d) as m'), 't.id', '=', 'm.id_truyen')
            ->select('t.*', 'm.ten_chap')->paginate(12);        
    
        return view('HomePage.Index', compact('all', 'near', 'update'));
    }

    public function detail($id) 
    {
        $truyen = Truyen::where('id', $id)->get();

        $TLoai= DB::table('theloai')
            ->join('truyen_theloai', 'theloai.id', '=', 'truyen_theloai.id_theloai')
            ->join('truyen', 'truyen.id', '=', 'truyen_theloai.id_truyen')
            ->where('truyen.id', $id)
            ->whereNull('truyen_theloai.deleted_at')
            ->select('theloai.the_loai', 'theloai.id')->get();

        $chap = DB::table('chap')
            ->where('id_truyen', $id)
            ->orderBy('id', 'desc')
            ->get();

        $comment = DB::table('comment')->join('users', 'comment.id_viewer', '=', 'users.id')
            ->where('id_truyen', $id)->whereNull('comment.deleted_at')
            ->select('comment.*', 'users.name', 'users.avatar')->orderBy('comment.id', 'desc')->get();

        $count = DB::table('comment')->join('users', 'comment.id_viewer', '=', 'users.id')
            ->where('id_truyen', $id)->whereNull('comment.deleted_at')
            ->count('comment.id');
        
        $min_chap = Chap::where('id_truyen', $id)->select('id')->orderBy('id', 'ASC')->first();
        if ($min_chap != null) {
            $min_chap  = $min_chap->id;
        }

        return view('HomePage.Detail', compact('truyen', 'TLoai', 'chap', 'comment', 'count', 'min_chap'));
    }

    public function reviewChap($id)
    {
        $img = Chap_noi_dung::where('id_chap', $id)->get();

        $title = DB::table('truyen')
            ->join('chap', 'truyen.id', '=', 'chap.id_truyen')
            ->where('chap.id', $id)
            ->select('truyen.ten_truyen', 'chap.ten_chap', 'chap.id_truyen', 'chap.id')
            ->groupBy('truyen.ten_truyen', 'chap.ten_chap', 'chap.id_truyen', 'chap.id')->get();

        $loai = DB::table('truyen')
            ->join('chap', 'truyen.id', '=', 'chap.id_truyen')
            ->where('chap.id', $id)
            ->select('truyen.loai_truyen')->first();
            
        $chap = DB::select('
            SELECT *
            FROM chap
            WHERE id_truyen = (SELECT id_truyen FROM chap WHERE id = '. $id .')'
        );

        $comment = DB::table('comment')->join('users', 'comment.id_viewer', '=', 'users.id')
            ->where('id_chap', $id)->whereNull('comment.deleted_at')
            ->select('comment.*', 'users.name', 'users.avatar')->orderBy('comment.id', 'desc')->get();

        $count = DB::table('comment')->join('users', 'comment.id_viewer', '=', 'users.id')
            ->where('id_chap', $id)->whereNull('comment.deleted_at')
            ->count('comment.id');

        $id_truyen = Chap::where('id', $id)->select('id_truyen')->first();
        $id_truyen = $id_truyen->id_truyen;

        $next_chap = Chap::where('id_truyen', $id_truyen)->where('id', '>', $id)->select('id')->first();
        if ($next_chap != null) {
            $next_chap = $next_chap->id;
        }

        $pre_chap = Chap::where('id_truyen', $id_truyen)->where('id', '<', $id)->select('id')->orderBy('id', 'DESC')->first();
        if ($pre_chap != null) {
            $pre_chap  = $pre_chap ->id;
        }

        $max_chap = Chap::where('id_truyen', $id_truyen)->select('id')->orderBy('id', 'DESC')->first();
        if ($max_chap != null) {
            $max_chap  = $max_chap->id;
        }
        
        $min_chap = Chap::where('id_truyen', $id_truyen)->select('id')->orderBy('id', 'ASC')->first();        
        if ($min_chap != null) {
            $min_chap  = $min_chap->id;
        }

        // dd($max_chap);

        if ($loai->loai_truyen == 2) {
            return view('HomePage/Read', compact('img', 'title', 'chap', 'comment', 'count', 'next_chap', 'pre_chap', 'max_chap', 'min_chap'));
        } else {
            return view('HomePage/Read_chu', compact('img', 'title', 'chap', 'comment', 'count', 'next_chap', 'pre_chap', 'max_chap', 'min_chap'));
        }
    }

    public function layTheoTL($id)
    {
        $truyen = DB::table('truyen as t')
            ->join('truyen_theloai', 't.id', '=', 'truyen_theloai.id_truyen')
            ->leftJoin(DB::raw('(SELECT * FROM chap c JOIN (SELECT h.id_truyen as i, MAX(h.ngay_dang) as d FROM chap h GROUP BY h.id_truyen) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang = latest_chap.d) as m'), 't.id', '=', 'm.id_truyen')
            ->select('t.*', 'm.ten_chap')
            ->where('truyen_theloai.id_theloai', $id)
            ->whereNull('truyen_theloai.deleted_at')
            ->paginate(12);

        // $truyen = DB::select('
        //     select t.*, m.ten_chap
        //     FROM truyen t
        //     join truyen_theloai on t.id = truyen_theloai.id_truyen and truyen_theloai.deleted_at is Null and truyen_theloai.id_theloai = '. $id. '
        //     LEFT JOIN (SELECT * FROM  chap c JOIN (
        //         SELECT h.id_truyen as i, MAX(h.ngay_dang) as d
        //         FROM chap h
        //         GROUP BY h.id_truyen
        //         ) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang=latest_chap.d) as m ON t.id = m.id_truyen'
        // );

        $theloai1 = The_loai::where('id', $id)->get();
        
        return view('HomePage.Find', compact('truyen', 'theloai1'));
    }
    
    public function search(Request $req)
    {
        $truyen = DB::table('truyen as t')
            ->leftJoin(DB::raw('(SELECT * FROM chap c JOIN (SELECT h.id_truyen as i, MAX(h.ngay_dang) as d FROM chap h GROUP BY h.id_truyen) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang = latest_chap.d) as m'), 't.id', '=', 'm.id_truyen')
            ->select('t.*', 'm.ten_chap')
            ->where('t.ten_truyen', 'like', '%'.$req->keySearch.'%')->paginate(12);

        $key = $req->keySearch;
        
        return view('HomePage.Find', compact('truyen', 'key'));
    }

    public function getType($req)
    {
        $truyen = DB::table('truyen as t')
            ->leftJoin(DB::raw('(SELECT * FROM chap c JOIN (SELECT h.id_truyen as i, MAX(h.ngay_dang) as d FROM chap h GROUP BY h.id_truyen) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang = latest_chap.d) as m'), 't.id', '=', 'm.id_truyen')
            ->select('t.*', 'm.ten_chap');
            
        switch ($req) {
        case 1:
            $truyen =  $truyen->where('t.loai_truyen', '<>', 2)->paginate(12);
            $key = 'Truyện chữ';
            break;
        case 2:
            $truyen =  $truyen->where('t.loai_truyen', 2)->paginate(12);
            $key = 'Manga';
            break;
        }

        return view('HomePage.Find', compact('truyen', 'key'));
    }

    public function getTop($req)
    {
        
        $truyen = DB::table('truyen as t')
            ->leftJoin(DB::raw('(SELECT * FROM chap c JOIN (SELECT h.id_truyen as i, MAX(h.ngay_dang) as d FROM chap h GROUP BY h.id_truyen) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang = latest_chap.d) as m'), 't.id', '=', 'm.id_truyen')
            ->select('t.*', 'm.ten_chap');
        
        switch ($req) {
        case 1:
            $truyen =  $truyen->orderBy('t.luot_thich', 'DESC')->paginate(12);
            $key = 'Top yêu thích';
            break;
        case 2:
            $truyen =  $truyen->orderBy('t.luot_theo_doi', 'DESC')->paginate(12);
            $key = 'Top theo dõi';
            break;
        case 3:
            $truyen =  $truyen->orderBy('t.luot_xem', 'DESC')->paginate(12);
            $key = 'Top lượt xem';
            break;
        }
        return view('HomePage.Find', compact('truyen', 'key'));
    }

    public function infoPage()
    {
        return view("HomePage.InfoPage");
    }
}
