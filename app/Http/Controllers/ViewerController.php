<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Truyen;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class ViewerController extends Controller
{
    public function list()
    {
        $viewer = User::where('group_role', 3)->get();

        return view('AdminPage/viewer', compact('viewer'));
    }

    public function postLogin(Request $req)
    {
        $remember = $req->customCheck;
        try {
            if (Auth::viaRemember()) {
                return response()->json(
                    [
                        'message' => 'Đăng nhập thành công'
                    ]
                );
            } else if (Auth::attempt(['email'=>$req->email, 'password'=>$req->password, 'is_active' => 1], $remember)) {
                Auth::user()->update(
                    [
                        'last_login_at' => date('Y-m-d H:i:s')
                    ]
                );
                return response()->json(
                    [
                        'message' => 'Đăng nhập thành công'
                    ]
                );
            } else {
                return response()->json(['errors' => 'Đăng nhập thất bại']);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }

    public function postRegister(Request $req)
    {
        try {

            $messages = [
                'email.required' => 'Email bắt buộc nhập',
                'email.email' => 'Nhập đúng cấu trúc email (vd: exemple@gmail.com)',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Mật khẩu bắt buộc nhập',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            ];

            $v = Validator::make(
                $req->all(),
                [
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6',

                ], $messages
            );
         
            if ($v->fails()) {
                return response()->json(['errors' => $v->errors()], 422);
            } else {

                $randomNumber = 'User'. rand(1, 100);

                $u = User::create(
                    [
                        'name' => $randomNumber,
                        'email' => $req->email,
                        'password' => Hash::make($req->password),
                        'group_role'=> 3,
                    ]
                );
                $u->save();
                return response()->json(
                    [
                        'message' => 'Đăng ký thành công'
                    ]
                );
            }
        } catch (e)
        {
            return back()->withError(e.getMessage());
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function store()
    {
        $truyen = Truyen::all();
        return view('HomePage.Store', compact('truyen'));
    }

    public function profile()
    {
        $id = Auth::id();
        $user = User::where('id', $id)->get();
        return view('HomePage.Profile', compact('user'));
    }
}
