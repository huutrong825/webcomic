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
        $all = DB::select(
            'select t.*, m.ten_chap
            FROM truyen t
            LEFT JOIN (SELECT * FROM  chap c JOIN (
                SELECT h.id_truyen as i, MAX(h.ngay_dang) as d
                FROM chap h
                GROUP BY h.id_truyen
                ) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang=latest_chap.d) as m ON t.id = m.id_truyen
            limit 12' 
        );

        $near = DB::select('
            select t.*, m.ten_chap
            FROM truyen t
            LEFT JOIN (SELECT * FROM  chap c JOIN (
                SELECT h.id_truyen as i, MAX(h.ngay_dang) as d
                FROM chap h
                GROUP BY h.id_truyen
                ) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang=latest_chap.d) as m ON t.id = m.id_truyen
            WHERE t.ngay_dang >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)'
        );
        
        $update = DB::select('
            select t.*, m.ten_chap
            FROM truyen t
            JOIN (SELECT * FROM  chap c JOIN (
                SELECT h.id_truyen as i, MAX(h.ngay_dang) as d
                FROM chap h
                GROUP BY h.id_truyen
                ) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang=latest_chap.d) as m ON t.id = m.id_truyen'
        );
        
    
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

        return view('HomePage.Detail', compact('truyen', 'TLoai', 'chap'));
    }

    public function reviewChap($id)
    {
        $img = Chap_noi_dung::where('id_chap', $id)->get();

        $title = DB::table('truyen')
            ->join('chap', 'truyen.id', '=', 'chap.id_truyen')
            ->where('chap.id', $id)
            ->select('truyen.ten_truyen', 'chap.ten_chap', 'chap.id_truyen')
            ->groupBy('truyen.ten_truyen', 'chap.ten_chap', 'chap.id_truyen')->get();
            
        $chap = DB::select('
            SELECT *
            FROM chap
            WHERE id_truyen = (SELECT id_truyen FROM chap WHERE id = 1)'
        );

        return view('HomePage/Read', compact('img', 'title', 'chap'));
    }

    public function layTheoTL($id)
    {
        
        $truyen = DB::select('
            select t.*, m.ten_chap
            FROM truyen t
            join truyen_theloai on t.id = truyen_theloai.id_truyen and truyen_theloai.id_theloai = '. $id. '
            LEFT JOIN (SELECT * FROM  chap c JOIN (
                SELECT h.id_truyen as i, MAX(h.ngay_dang) as d
                FROM chap h
                GROUP BY h.id_truyen
                ) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang=latest_chap.d) as m ON t.id = m.id_truyen'
        );

        $theloai1 = The_loai::where('id', $id)->get();
        
        return view('HomePage.Find', compact('truyen', 'theloai1'));
    }
    
    public function search(Request $req)
    {
        $truyen =  DB::select('
            select t.*, m.ten_chap
            from truyen t            
            LEFT JOIN (SELECT * FROM  chap c JOIN (
                SELECT h.id_truyen as i, MAX(h.ngay_dang) as d
                FROM chap h
                GROUP BY h.id_truyen
                ) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang = latest_chap.d) as m ON t.id = m.id_truyen
            where t.ten_truyen LIKE ?', ['%'.$req->keySearch. '%']
        );

        $key = $req->keySearch;
        
        return view('HomePage.Find', compact('truyen', 'key'));
    }

    public function getType($req)
    {
        switch ($req) {
        case 1:
            $truyen =  DB::select('
                select t.*, m.ten_chap
                from truyen t            
                LEFT JOIN (SELECT * FROM  chap c JOIN (
                    SELECT h.id_truyen as i, MAX(h.ngay_dang) as d
                    FROM chap h
                    GROUP BY h.id_truyen
                    ) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang = latest_chap.d) as m ON t.id = m.id_truyen
                where t.loai_truyen <> ?', [2]
            );
            $key = 'Truyện chữ';
            break;
        case 2:
            $truyen =  DB::select('
                select t.*, m.ten_chap
                from truyen t            
                LEFT JOIN (SELECT * FROM  chap c JOIN (
                    SELECT h.id_truyen as i, MAX(h.ngay_dang) as d
                    FROM chap h
                    GROUP BY h.id_truyen
                    ) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang = latest_chap.d) as m ON t.id = m.id_truyen
                where t.loai_truyen = ?', [2]
            );
            $key = 'Manga';
            break;
        }     

        return view('HomePage.Find', compact('truyen', 'key'));
    }
}
