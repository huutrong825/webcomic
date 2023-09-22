<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chap_Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChapErrorController extends Controller
{
    public function errorChap(Request $r)
    {
        if (Auth::check()) {
            $user = Auth::id();

            $messages = [                
                'txtError.required' => 'Nhập nội dung lỗi',
                'txtError.min' => 'Nội dung ít nhất 10 ký tự',
            ];

            $v = Validator::make(
                $r->all(),
                [
                    'txtError' => 'required|min:10',
                ], $messages
            );
         
            if ($v->fails()) {
                return response()->json(['errors' => $v->errors()], 422);
            } else {

                Chap_error::create(
                    [
                        'id_truyenloi' => $r->id_truyen,
                        'id_chap' => $r->id_chap, 
                        'id_viewer' => $user, 
                        'mess_loi' => $r->txtError
                    ]
                );
                return response()->json(['message' => "Báo lỗi thành công"]);
            }
        } else {
            return response()->json(['errors' => "Phải đăng nhập"]);
        }
    }
}
