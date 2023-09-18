<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    public function getLogin()
    {
        return view('AdminPage.login');
    }

    public function postLogin(Request $req)
    {
        $remember = $req->customCheck;
        try {
            if (Auth::viaRemember()) {
                return redirect('/admin');
            } else if (Auth::attempt(['email'=>$req->email, 'password'=>$req->password, 'is_active' => 1, 'group_role' => 1], $remember)) {
                Auth::user()->update(
                    [
                        'last_login_at' => date('Y-m-d H:i:s')
                    ]
                );
                return redirect('/admin');
            } else {
                return redirect('/login-admin')->with('error', 'Email hoặc mật khẩu không đúng');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }
    public function getRegister()
    {
        return view('AdminPage.register');
    }

    public function postRegister(Request $req)
    {
        try {

            $messages = [
                'email.required' => 'Email bắt buộc nhập',
                'email.email' => 'Nhập đúng cấu trúc email (vd: exemple@gmail.com)',
                'email.unique' => 'Email đã tồn tại',
                'txtname.required' => 'Tên user bắt buộc nhập',
                'password.required' => 'Mật khẩu bắt buộc nhập',
                'password.confirmed' => 'Mật khẩu phải giống nhau',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            ];

            $v = Validator::make(
                $req->all(),
                [
                    'email' => 'required|email|unique:users',
                    'txtname' => 'required',
                    'password' => 'required|confirmed|min:6',

                ], $messages
            );
         
            if ($v->fails()) {
                return response()->json(['errors' => $v->errors()], 422);
            } else {

                $u = User::create(
                    [
                        'name' => $req->txtname,
                        'email' => $req->email,
                        'password' => Hash::make($req->password),
                        'group_role'=> $req->ad_level,
                    ]
                );
                $u->save();
                return response()->json(
                    [
                        'message' => 'Thành công'
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

        return redirect('/login-admin');
    }

    public function getProfile()
    {
        try {
            if (Auth::check()) {
                $id = Auth::id();
                $user = User::where('id', $id)->get();
                return view('AdminPage.profile', compact('user'));
            } else {
                return view('AdminPage.profile');
            }
        } catch (Exception $e){
            return $e->getMessage();
        }        
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
    
    public function userPage()
    {
        return view('AdminPage.user_admin');
    }

    public function listUser()
    {
        $user = User::whereNot('group_role', 3)->get();

        return Datatables::of($user)->
        addColumn(
            'group_role', function ($user) {
                $temp = $user->group_role == 1? "Admin" : ($user->group_role == 2 ? "Employee" : "Errol" );
                return $temp;
            }
        )
        ->addColumn(
            'is_active', function ($user) {
                $temp = $user->is_active != 0? '<span style="color:green">Đang hoạt động</span>' :
                '<span style="color:red">Ngưng hoạt động</span>';
                return $temp;
            }
        )
        ->addColumn(
            'action', function ($user) {
                return '<a value="'. $user->id .'" class="btn btn-success btn-circle btn-sm bt-Update">
                <i class="fas fa-pen"></i></a>
                
                <a value="'. $user->id .'" class="btn btn-danger btn-circle btn-sm bt-Delete">
                <i class="fas fa-trash"></i></a> 

                <a value="'. $user->id .'" class="btn btn-warning btn-circle btn-sm bt-Block">
                <i class="fas fa-user-times"></i></a>';
            }
        )
        ->rawColumns(['group_role','is_active','action'])
        ->make(true);
    }
}
