<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function list()
    {
        $comment = DB::table('comment')
            ->join('users', 'users.id', '=', 'comment.id_viewer')
            ->join('truyen', 'truyen.id', '=', 'comment.id_truyen')
            ->select('comment.*', 'users.name', 'truyen.ten_truyen')->get();
        
        return view('AdminPage.Comment', compact('comment'));
    }

    public function postComment(Request $r)
    {
        
        if (Auth::check()) {

            $messages = [
                'comment.required' => 'Bình luận bắt buộc nhập',
                'comment.min' => 'Bình luận ít nhất 6 ký tự',
            ];

            $v = Validator::make(
                $r->all(),
                [
                    'comment' => 'required|min:6',
                ], $messages
            );
         
            if ($v->fails()) {
                return response()->json(['errors' => $v->errors()], 422);
            } else {

                $idchap = null;

                if ($r->id_chap) {
                    $idchap = $r->id_chap;
                }
                
                Comment::create(
                    [
                        'id_truyen' => $r->id_truyen,
                        'id_viewer' => Auth::id(),
                        'noi_dung' => $r->comment,
                        'id_chap' => $idchap,
                        'ngay_dang' => date('Y-m-d H:i:s'),
                    ]
                );
                return response()->json(['message' => "Bình luận thành công"]);
            }

        } else {
            return response()->json(['errors' => "Phải đăng nhập"]);
        }
    }

    public function getComment($id)
    {
        $comment = Comment::where('id', $id)->first();

        return response()->json(
            [
                'comment' => $comment
            ]
        );
    }

    public function deletedComment($id)
    {
        $comment = Comment::where('id', $id)->first();

        if ($comment) {

            $comment->delete();

            return response()->json(
                [
                    'message' => "Xóa bình luận thành công"
                ]
            );
            
        } else {
            return response()->json(['errors' => 'Không tìm thấy bình luận trong dữ liệu']);
        }
    }
}
