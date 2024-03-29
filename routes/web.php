<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/12',
// function () {
//     return view('AdminPage/truyen-tranh');}
// );



// Route::get('/14',
// function () {
//     return view('AdminPage/noi-dung-truyen');}
// );

// Route::get('/15',
// function () {
//     return view('AdminPage/them-truyen');}
// );

// Route::get('/16',
// function () {
//     return view('AdminPage/xep-hang');}
// );

// Route::get('/', ['uses'=>'HomePageController@all']);

// Route::get('/chi-tiet/{id}', ['uses'=>'HomePageController@detail']);
// Route::get('/truyen/{id}', ['uses'=>'HomePageController@reviewChap']);

// Route::get('/search/{id}', ['uses'=>'HomePageController@layTheoTL']);
// Route::get('/search', ['uses'=>'HomePageController@search']);





// Route::get('/theloai',
// function () {
//     return view('AdminPage.the-loai');}
// );

// Route::get('/the-loai', ['uses'=>'TheLoaiController@theLoai']);
// Route::post('/them-the-loai', ['uses'=>'TheLoaiController@themTheLoai']);

// Route::get('/loai', ['uses'=>'LoaiTruyenController@Loai']);
// Route::post('/them-loai', ['uses'=>'LoaiTruyenController@themLoai']);

// Route::post('/truyen/them_moi', ['uses'=>'TruyenController@themTruyen']);
// Route::post('/truyen/them_chap', ['uses'=>'TruyenController@']);
// Route::get('/truyen-tranh', ['uses'=>'TruyenController@truyenTranh']);
// Route::get('/truyen-tranh/{id}', ['uses'=>'TruyenController@detail']);

// Route::get('/viewer', ['uses'=>'ViewerController@list']);

// Route::get('/truyen-chu', ['uses'=>'TruyenController@truyenChu']);

// Route::post('/update/tac_gia/{id}', ['uses'=>'TruyenController@updateTacgia']);
// Route::post('/update/nhomdich/{id}', ['uses'=>'TruyenController@updateDich']);
// Route::post('/update/mota/{id}', ['uses'=>'TruyenController@updateMota']);
// Route::post('/update/theloai/{id}', ['uses'=>'TruyenController@updateTheloai']);
// Route::post('/update/anhbia/{id}', ['uses'=>'TruyenController@updateAnhbia']);
// Route::post('/update/trangthai/{id}', ['uses'=>'TruyenController@updateTrangthai']);
// Route::post('/delete/theloai/{id}', ['uses'=>'TruyenController@deleteTheloai']);


// Route::get('/comment',
// function () {
//     return view('AdminPage/Comment');}
// );
// Route::get('/xep-hang',
// function () {
//     return view('AdminPage/xep-hang');}
// );

// Route::get('/thong-tin',
// function () {
//     return view('AdminPage/thong-tin');}
// );

// Route::get('/login', ['uses'=>'UsersController@getLogin']);
// Route::post('/login', ['uses'=>'UsersController@postLogin']);
// Route::get('/register', ['uses'=>'UsersController@getRegister']);
// Route::post('/register', ['uses'=>'UsersController@postRegister']);
// Route::get('/logout', ['uses'=>'UsersController@getLogout']);

// Route::get('/profile', ['uses'=>'UsersController@getProfile']);
// Route::post('/profile', ['uses'=>'UsersController@updateAvatar']);
// Route::post('/profile/info', ['uses'=>'UsersController@updateInfo']);
// Route::post('/changePass', ['uses'=>'UsersController@changePass']);

// Route::get('/user-admin',['uses'=>'UsersController@userPage']);
// Route::get('/user-admin/fetch',['uses'=>'UsersController@listUser']);

// Route::get('/nd_chu',
// function () {
//     return view('AdminPage/ND_truyen_chu');}
// );

// Route::get('/admin',
//  function () {
//         return view('AdminPage/Index');
//     }
// );

// Route::post('/them-chap/{id}', ['uses'=>'ChapController@themChap']);

// Route::get('/the-loai/getId/{id}', ['uses'=>'TheLoaiController@getID']);
// Route::put('/the-loai/update/{id}', ['uses'=>'TheLoaiController@update']);

// Route::get('/loai/getId/{id}', ['uses'=>'LoaiTruyenController@getID']);
// Route::put('/loai/update/{id}', ['uses'=>'LoaiTruyenController@update']);

// Route::get('/truyen/chap/{id}', ['uses'=>'ChapController@chapND']);
// Route::post('/truyen/chap/{id}', ['uses'=>'ChapController@themImage']);
// Route::get('/truyen/chap/review/{id}', ['uses'=>'ChapController@reviewImage']);
// Route::get('/truyen/review-chap/{id}', ['uses'=>'ChapController@reviewChap']);


Route::get('/login-admin', ['uses'=>'UsersController@getLogin']);
Route::post('/login-admin', ['uses'=>'UsersController@postLogin']);
Route::group(
    ['middleware'=>'AdminLogin', 'prefix'=>'admin'], function () {

        Route::get(
            '/', function () {
                return view('AdminPage/Index');
            }
        );

        Route::group(
            ['prefix'=>'profile'], function () {
                Route::get('/', ['uses'=>'UsersController@getProfile']);
                Route::post('/', ['uses'=>'UsersController@updateAvatar']);
                Route::post('/info', ['uses'=>'UsersController@updateInfo']);
                Route::post('/changePass', ['uses'=>'UsersController@changePass']);
            }
        );

            Route::get('/register', ['uses'=>'UsersController@getRegister']);
            Route::post('/register', ['uses'=>'UsersController@postRegister']);
            Route::get('/logout', ['uses'=>'UsersController@getLogout']);



        //Truyện
        Route::group(
            ['prefix'=>'truyen'], function () {
                Route::get('/chap/{id}', ['uses'=>'ChapController@chapND']);
                Route::post('/chap/{id}', ['uses'=>'ChapController@themImage']);
                Route::get('/chap/review/{id}', ['uses'=>'ChapController@reviewImage']);
                Route::get('/chap/get/{id}', ['uses'=>'ChapController@getChap']);
                Route::get('/chap/delete/{id}', ['uses'=>'ChapController@deleteChap']);
                Route::get('/review-chap/{id}', ['uses'=>'ChapController@reviewChap']);
                Route::get('/them-moi', ['uses'=>'TruyenController@viewAdd']);
                Route::post('/them_moi', ['uses'=>'TruyenController@themTruyen']);
                Route::post('/them-chap/{id}', ['uses'=>'ChapController@themChap']);                
            }
        );

        //Update truyện
        Route::group(
            ['prefix'=>'update'], function () {
                Route::post('/tac_gia/{id}', ['uses'=>'TruyenController@updateTacgia']);
                Route::post('/nhomdich/{id}', ['uses'=>'TruyenController@updateDich']);
                Route::post('/mota/{id}', ['uses'=>'TruyenController@updateMota']);
                Route::post('theloai/{id}', ['uses'=>'TruyenController@updateTheloai']);
                Route::post('/anhbia/{id}', ['uses'=>'TruyenController@updateAnhbia']);
                Route::post('/trangthai/{id}', ['uses'=>'TruyenController@updateTrangthai']);
            }
        );
        Route::post('/delete/theloai/{id}', ['uses'=>'TruyenController@deleteTheloai']);

        //Truyện tranh
        Route::group(
            ['prefix'=>'truyen-tranh'], function () {
                Route::get('/', ['uses'=>'TruyenController@truyenTranh']);
                Route::get('/{id}', ['uses'=>'TruyenController@detail']);
                Route::get('/getTruyen/{id}', ['uses'=>'TruyenController@getTruyen']);
                Route::get('/delete/{id}', ['uses'=>'TruyenController@deleteTruyen']);
            }
        );

        // Truyện chữ
        Route::group(
            ['prefix'=>'truyen-chu'], function () {
                Route::get('/', ['uses'=>'TruyenController@truyenChu']);
                Route::get('/them-nd/{id}', ['uses'=>'ChapController@chapChu']);
                Route::post('/them-nd/{id}', ['uses'=>'ChapController@themND']);
                Route::get('/review-chap/{id}', ['uses'=>'ChapController@reviewChapChu']);
                Route::get('/get-chap/{id}', ['uses'=>'ChapController@getNDChapChu']);
                Route::put('/update/{id}', ['uses'=>'ChapController@updateND']);
            }
        );
        
        

        // Loại
        Route::group(
            ['prefix'=>'loai'], function () {
                Route::get('/', ['uses'=>'LoaiTruyenController@Loai']);
                Route::post('/them-loai', ['uses'=>'LoaiTruyenController@themLoai']);
                Route::get('/getId/{id}', ['uses'=>'LoaiTruyenController@getID']);
                Route::put('/update/{id}', ['uses'=>'LoaiTruyenController@update']);
                Route::get('/delete/{id}', ['uses'=>'LoaiTruyenController@delete']);
            }
        );

        // Thể Loại
        Route::group(
            ['prefix'=>'the-loai'], function () {
                Route::get(
                    '/',  function () {
                        return view('AdminPage.the-loai');
                    }
                );
                Route::get('/fetch', ['uses'=>'TheLoaiController@theLoai']);
                Route::post('/them-the-loai', ['uses'=>'TheLoaiController@themTheLoai']);
                Route::get('/getId/{id}', ['uses'=>'TheLoaiController@getID']);
                Route::put('/update/{id}', ['uses'=>'TheLoaiController@update']);
                Route::get('/delete/{id}', ['uses'=>'TheLoaiController@delete']);
            }
        );


        // Danh sách admin
        Route::group(
            ['prefix'=>'user-admin'], function () {
                Route::get('/', ['uses'=>'UsersController@userPage']);
                Route::get('/fetch', ['uses'=>'UsersController@listUser']);
            }
        );

        Route::get('/viewer', ['uses'=>'ViewerController@list']);
        Route::get('/get-viewer/{id}', ['uses'=>'ViewerController@getUser']);
        Route::get('/block-viewer/{id}', ['uses'=>'ViewerController@blockUser']);
        Route::get('/delete-viewer/{id}', ['uses'=>'ViewerController@deleteUser']);

        Route::get('/comment', ['uses'=>'CommentController@list']);
        Route::get('/comment/get/{id}', ['uses'=>'CommentController@getComment']);
        Route::get('/comment/deleted/{id}', ['uses'=>'CommentController@deletedComment']);

        Route::get('/error', ['uses'=>'ChapErrorController@listError']);

        Route::get('/xep-hang',
        function () {
            return view('AdminPage/xep-hang');}
        );

        Route::get('/thong-tin', ['uses'=>'InfoPageController@tongQuan']);

        Route::group(
            ['prefix'=>'banner'], function () {
                Route::get('/fetch', ['uses'=>'InfoPageController@banner']);
                Route::get('/{id}', ['uses'=>'InfoPageController@getTruyen']);
                Route::post('/', ['uses'=>'InfoPageController@createBanner']);
                Route::get('/getBanner/{id}', ['uses'=>'InfoPageController@getBanner']);
                Route::post('/update/{id}', ['uses'=>'InfoPageController@updateBanner']);
                Route::get('/delete/{id}', ['uses'=>'InfoPageController@deleteBanner']);
            }
        ); 

        Route::group(
            ['prefix'=>'info'], function () {
                Route::get('/fetch', ['uses'=>'InfoPageController@info']);
                Route::get('/getInfo', ['uses'=>'InfoPageController@getInfo']);
                Route::post('/updatedInfo', ['uses'=>'InfoPageController@updateInfo']);
            }
        );
        

    }
);

//Group route Homepage
Route::group(
    [ 'prefix'=>'/'], function () {
        Route::get('/', ['uses'=>'HomePageController@all']);

        Route::get('/chi-tiet/{id}', ['uses'=>'HomePageController@detail']);
        Route::get('/truyen/chap/{id}', ['uses'=>'HomePageController@reviewChap']);

        Route::get('/search/{id}', ['uses'=>'HomePageController@layTheoTL']);
        Route::get('/search', ['uses'=>'HomePageController@search']);

        Route::post('/login', ['uses'=>'ViewerController@postLogin']);
        Route::post('/register', ['uses'=>'ViewerController@postRegister']);
        Route::get('/logout', ['uses'=>'ViewerController@getLogout']);

        Route::get('/lay-top/{req}', ['uses'=>'HomePageController@getTop']);

        Route::group(
            ['prefix'=>'profile'], function () {
                Route::get('/', ['uses'=>'ViewerController@profile']);
                Route::post('/avatar', ['uses'=>'ViewerController@updateAvatar']);
                Route::post('/info', ['uses'=>'ViewerController@updateInfo']);
                Route::post('/changePass', ['uses'=>'ViewerController@changePass']);
            }
        );

        Route::get('/loai-truyen/{req}', ['uses'=>'HomePageController@getType']);
        Route::get('/info-page', ['uses'=>'HomePageController@infoPage']);

        Route::get('/add-store/{id}', ['uses'=>'StoreController@addStore']);
        Route::get('/kho-luu-tru', ['uses'=>'StoreController@getStore']);
        Route::get('/like/{id}', ['uses'=>'StoreController@like']);
        Route::get('/view/{id}', ['uses'=>'StoreController@countRead']);

        Route::post('/post-comment', ['uses'=>'CommentController@postComment']);
        Route::post('/send-error', ['uses'=>'ChapErrorController@errorChap']);
    }
);