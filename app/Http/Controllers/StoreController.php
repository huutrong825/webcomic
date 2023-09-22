<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Truyen;
use App\Models\Store_truyen;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function addStore($id)
    {
        if (Auth::check()) {
            $user = Auth::id();

            $store = Store_truyen::where('id_truyen', $id)
                ->where('id_viewer', $user)->first();
            $truyen = Truyen::where('id', $id)->first();

            if ($store) {
                $store->delete();
                if ($truyen->luot_theo_doi > 0) {
                    $count = $truyen->luot_theo_doi - 1;
                    $truyen->update(
                        [
                            'luot_theo_doi' => $count
                        ]
                    );
                }
                return response()->json(['message' => "Đã hủy theo dõi"]);
            } else {
                $count = $truyen->luot_theo_doi + 1;
                
                $truyen->update(
                    [
                        'luot_theo_doi' => $count
                    ]
                );

                Store_truyen::create(
                    [
                        'id_truyen' => $id,
                        'id_viewer' => $user
                    ]
                );
                return response()->json(['message' => "Theo dõi thành công"]);
            }
        } else {
            return response()->json(['errors' => "Phải đăng nhập"]);
        }
    }
    public function getStore()
    {
        if (Auth::check()) {
            $user = Auth::id();

            $truyen = DB::table('truyen as t')
                ->join('chap_store_truyen as st', 't.id', '=', 'st.id_truyen')
                ->leftJoin(DB::raw('(SELECT * FROM chap c JOIN (SELECT h.id_truyen as i, MAX(h.ngay_dang) as d FROM chap h GROUP BY h.id_truyen) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang = latest_chap.d) as m'), 't.id', '=', 'm.id_truyen')
                ->select('t.*', 'm.ten_chap')
                ->where('st.id_viewer', $user)
                ->whereNull('st.deleted_at')
                ->paginate(12);

            // $truyen = DB::select('
            //     select t.*, m.ten_chap
            //     FROM truyen t
            //     join chap_store_truyen as s on t.id = s.id_truyen and s.deleted_at is null and s.id_viewer = '. $user. '
            //     LEFT JOIN (SELECT * FROM  chap c JOIN (
            //         SELECT h.id_truyen as i, MAX(h.ngay_dang) as d
            //         FROM chap h
            //         GROUP BY h.id_truyen
            //         ) as latest_chap ON c.id_truyen = latest_chap.i and c.ngay_dang=latest_chap.d) as m ON t.id = m.id_truyen'
            // );

            return view('HomePage.Store', compact('truyen'));

         
        } else {
            return response()->json(['errors' => "Phải đăng nhập"]);
        }
    }

    public function like($id)
    {
        $truyen = Truyen::where('id', $id)->first();

        $count = $truyen->luot_thich + 1;
            
        $truyen->update(
            [
                'luot_thich' => $count
            ]
        );

        return response()->json(['message' => "Đã thích"]);
    }

    public function countRead($id)
    {
        $truyen = Truyen::where('id', $id)->first();

        $count = $truyen->luot_xem + 1;
            
        $truyen->update(
            [
                'luot_xem' => $count
            ]
        );
        return response()->json(['message' => "Đã thích"]);
    }
}