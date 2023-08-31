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
                        'avatar' => 'avatar.png',
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
    public function updateAvatar(Request $req)
    {
        try {
            $id = Auth::id();
            $user = User::findOrFail($id);
            if ($user) {
                if ($req->file('input_av')) {
                  
                    $messages = [
                        'input_av.image' => 'Chỉ được phép nhập ảnh',
                        'input_av.mimes' => 'Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png .gif',
                    ];
        
                    $v = Validator::make(
                        $req->all(),
                        [
                            'input_av' => 'image|mimes:jpg,jpeg,png,gif',
        
                        ], $messages
                    );

                    if ($v->fails()) {
                        return response()->json(['errors' => $v->errors()], 422);
                    } else {

                        $img_name = '';
                        if ($req->file('input_av')->isValid()) {
                            $img = $req->input_av;
                            $img_name = $img->getClientOriginalName();
                            $img->move(public_path('img'), $img_name);  
                        }
                        $user->update(
                            [
                                'avatar' => $img_name,
                            ]
                        );
                        return response()->json(
                            [
                                'message' => 'Cập nhật ảnh đại diện thành công'
                            ]
                        );
                    }
                } else {
                    return response()->json(['errors' => "Cập nhật thất bại"]);
                }
            }
        } catch (Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()], 404);
        }
    }

    public function updateInfo(Request $req)
    {
        try {
            $id = Auth::id();
            $user = User::findOrFail($id);
            if ($user) {

                $messages = [
                    'username.min' => 'Tên dài hơn 1 ký tự',
                ];
    
                $v = Validator::make(
                    $req->all(),
                    [
                        'username' => 'min:1',
    
                    ], $messages
                );
             
                if ($v->fails()) {
                    return response()->json(['errors' => $v->errors()], 422);
                } else {
                    $user->update(
                        [
                            'name' => $req->username,
                            'birth' => $req->birth
                        ]
                    );
                    return response()->json(
                        [
                            'message' => 'Cập nhật thành công'
                        ]
                    );
                }
            }
        } catch (Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()], 404);
        }
    }

    public function changePass(Request $req)
    {
       
        try {
            $id = Auth::id();
            $user = User::findOrFail($id);
            if ($user) {

                $messages = [
                    'lastPass.required' => 'Nhập mật khẩu cũ',
                    'password.required' => 'Mật khẩu mới bắt buộc nhập',
                    'password.confirmed' => 'Mật khẩu xác nhận phải giống mật khẩu mới',
                    'password.min' => 'Mật khẩu ít nhất 6 ký tự',
                ];
    
                $v = Validator::make(
                    $req->all(),
                    [
                        'lastPass' => 'required',
                        'password' => 'required|confirmed|min:6',
    
                    ], $messages
                );
             
                if ($v->fails()) {
                    return response()->json(['errors' => $v->errors()], 422);
                } else {
                    if (Auth::attempt(['email' => $user->email, 'password' => $req->lastPass])) {
                        if ($req->password == $req->password_confirmation) {
                            $user->update(
                                [
                                    'password' => Hash::make($req->password_confirmation)
                                ]
                            );
                            return response()->json(
                                [
                                    'message' => 'Cập nhật thành công'
                                ]
                            );
                        }
                    } else {
                        return response()->json(
                            [
                                'errors' => 'Mật khẩu không đúng'
                            ]
                        );
                    }
                }
            }
        } catch (Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()], 404);
        }
    }
}
