<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function list()
    {
        $comment = DB::table('comment')
            ->join('users', 'users.id', '=', 'comment.id_viewer')
            ->select('comment.*', 'users.name')->get();
        
        return view('AdminPage.Comment', compact('comment'));
    }

    public function postComment(Request $r)
    {
        dd($r->all());
    }
}
