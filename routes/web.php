<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "ClientHomeController@getHome")->name('home');

Route::get('dang-nhap', "UserController@getLogin")->name('getLogin');

Route::post('dang-nhap', "UserController@postLogin")->name('postLogin');

Route::get('dang-ky', "UserController@getRegister")->name('register');

Route::post('dang-ky', "UserController@postRegister");

Route::get('logout', "UserController@logout")->name('logout');



Route::group(['prefix' => 'admin', 'middleware'=>'admin'], function() {

    Route::get('/', "AdminUserController@home")->name('adminHome');

    Route::get('changePassword.html', "AdminUserController@getChangePassword")->name('getChangePass');

    Route::post('changePassword.html', "AdminUserController@postChangePassword")->name('postChangePass');

    Route::get('thong-tin-ca-nhan', "AdminUserController@getChangeInfo")->name('changeInfomation');

    Route::post('thong-tin-ca-nhan', "AdminUserController@postChangeInfo");
    

    Route::group(['prefix' => 'contact', 'middleware' => 'adminContact'], function() {

        Route::get('/', "AdminContactController@getList")->name('contactList');

        Route::get('phan-hoi/{id}', "AdminContactController@getView");

        Route::post('phan-hoi/{id}', "AdminContactController@postView");

        Route::get('xoa/{id}.html', "AdminContactController@getDelete");

    });


    Route::group(['prefix' => 'danh-muc', 'middleware' => 'adminPostCategory'], function() {
        
        Route::get('/', "AdminPostCategorysController@getList")->name('categoryList');

        Route::get('them-moi', "AdminPostCategorysController@getAdd")->name("getAddCategory");

        Route::post('them-moi', "AdminPostCategorysController@postAdd")->name('postAddCategory');

        Route::get('chinh-sua/{id}.html', "AdminPostCategorysController@getEdit")->name("getEditCategory");

        Route::post('chinh-sua/{id}.html', "AdminPostCategorysController@postEdit")->name("postEditCategory");

        Route::get('xoa/{id}.html', "AdminPostCategorysController@getDelete")->name("getDeleteCategory");

        Route::get('bai-viet/{unsigned_title}', "AdminPostOfCategoryController@get")->name('postOfCate')->where('unsigned_title','^[a-z0-9-/+]{3,10000}$');


    });

    Route::group(['prefix' => 'bai-viet', 'middleware' => 'adminPost'], function() {

        Route::get('/', "AdminPostController@getList")->name("posts");

        Route::get('them-moi', "AdminPostController@getAdd")->name("getAddPost");

        Route::post('them-moi', "AdminPostController@postAdd")->name("postAddPost");

        Route::get('chinh-sua/{id}.html', "AdminPostController@getEdit")->name("getEditPost");

        Route::post('chinh-sua/{id}.html', "AdminPostController@postEdit")->name("postEditPost");

        Route::get('xoa/{id}.html', "AdminPostController@getDelete")->name("getDeletePost");

        Route::get('passPost', "AdminPostController@getPass")->name("getPassPost");

        Route::get('bai-viet-ajax', "AdminPostController@getAjax")->name('post-ajax');


    });

    Route::group(['prefix' => 'tep-tin', 'middleware' => 'adminFile'], function() {

        Route::get('/', "AdminFilesController@getList")->name('files');

        Route::get('them-moi', "AdminFilesController@getAdd")->name('getAddFile');

        Route::post('them-moi', "AdminFilesController@postAdd");

        Route::get('chinh-sua/{id}.html', "AdminFilesController@getEdit");

        Route::post('chinh-sua/{id}.html', "AdminFilesController@postEdit");

        Route::get('xoa/{id}.html', "AdminFilesController@getDelete");

    });

    Route::group(['prefix' => 'banner', 'middleware' => 'adminBanner'], function() {

        Route::get('/', "AdminBannerController@getList")->name("banner");

        Route::get('them-moi', "AdminBannerController@getAdd")->name("getAddBanner");

        Route::post('them-moi', "AdminBannerController@postAdd")->name("postAddBanner");

        Route::get('chinh-sua/{id}.html', "AdminBannerController@getEdit")->name("getEditBanner");

        Route::post('chinh-sua/{id}.html', "AdminBannerController@postEdit")->name("postEditBanner");

        Route::get('chinh-sua-live/{id}.html', "AdminBannerController@postEdit")->name("postEditLiveBanner");

        Route::get('xoa/{id}.html', "AdminBannerController@getDelete");


    });

    Route::group(['prefix' => 'slide', 'middleware' => 'adminSlide'], function() {
        
        Route::get('/', "AdminSlideController@getList")->name("slide");

        Route::get('them-moi', "AdminSlideController@getAdd")->name("getAddSlide");

        Route::post('them-moi', "AdminSlideController@postAdd")->name("postAddSlide");

        Route::get('chinh-sua/{id}.html', "AdminSlideController@getEdit")->name("getEditSlide");

        Route::post('chinh-sua/{id}.html', "AdminSlideController@postEdit")->name("postEditSlide");

        Route::post('chinh-sua-live/{id}.html', "AdminSlideController@postEditLive")->name("postEditLiveSlide");

        Route::get('xoa/{id}.html', "AdminSlideController@getDelete");

    });

    Route::group(['prefix' => 'slogan', 'middleware' => 'adminSlogan'], function() {

        Route::get('/', "AdminSloganController@getList")->name("slogan");

        Route::get('them-moi', "AdminSloganController@getAdd")->name("getAddSlogan");

        Route::post('them-moi', "AdminSloganController@postAdd")->name("postAddSlogan");

        Route::get('chinh-sua/{id}.html', "AdminSloganController@getEdit")->name("getEditSlogan");

        Route::post('chinh-sua/{id}.html', "AdminSloganController@postEdit")->name("postEditSlogan");

        Route::get('xoa/{id}.html', "AdminSloganController@getDelete");

    });


    Route::group(['prefix' => 'video', 'middleware' => 'adminVideo'], function() {

        Route::get('/', "AdminVideoController@getList")->name("video");

        Route::get('them-moi', "AdminVideoController@getAdd")->name("getAddVideo");

        Route::post('them-moi', "AdminVideoController@postAdd")->name("postAddVideo");

        Route::get('chinh-sua/{id}.html', "AdminVideoController@getEdit")->name("getEditVideo");

        Route::post('chinh-sua/{id}.html', "AdminVideoController@postEdit")->name("postEditVideo");

        Route::post('chinh-sua-live/{id}.html', "AdminVideoController@postEditLive")->name("postEditLiveVideo");

        Route::get('xoa/{id}.html', "AdminVideoController@getDelete");


    });

    Route::group(['prefix' => 'user', 'middleware'=>'adminUser'], function() {

        Route::get('/', "AdminUserController@getListUser")->name('adminUser');

        Route::get('danh-sach', "AdminUserController@getListUser")->name('adminUserList');

        Route::get('them-moi', "AdminUserController@getAddUser")->name('adminUsergetAdd');

        Route::post('them-moi', "AdminUserController@postAddUser")->name('adminUserpostAdd');

        Route::get('chinh-sua/{username}', "AdminUserController@getEdit")->name('adminUsergetEdit');

        Route::post('chinh-sua/{username}', "AdminUserController@postEdit")->name('adminUserpostEdit');

        Route::get('reset-pass/{username}', "AdminUserController@getResetPass")->name('adminResetPass');

        Route::get('xoa/{username}', "AdminUserController@getDelete")->name('deleteUser');

    });

    Route::group(['prefix' => 'thong-tin', 'middleware'=>'adminInfo'], function() {

        Route::get('/', "AdminInformationController@get")->name('infomation');

        Route::post('/', "AdminInformationController@post")->name('postInfomation');

    });

    Route::group(['prefix' => 'lien-ket', 'middleware' => 'adminSlogan'], function() {

        Route::get('/', "AdminLinksController@getList")->name('links');

        Route::get('them-moi', "AdminLinksController@getAdd")->name('getAddLink');

        Route::post('them-moi', "AdminLinksController@postAdd");

        Route::post('chinh-sua/{id}.html', "AdminLinksController@postEdit")->name('editLink');

        Route::get('xoa/{id}.html', "AdminLinksController@getDelete");

    });

    Route::group(['prefix' => 'thong-ke'], function() {
        
        Route::get('/', function() {
            
        });

    });


});

Route::get('tim-kiem', "ClientSearchController@get")->name('search');

Route::get('gioi-thieu-chung', "ClientHomeController@getAbout")->name('about');
Route::get('co-cau-to-chuc', "ClientHomeController@getOrganization")->name('organization');
Route::get('lien-he', "ClientHomeController@getContact")->name('contact');
Route::post('lien-he', "ClientHomeController@postContact");

Route::get('file/{unsigned_title}', "ClientFileController@get")->name('fileDetail');

Route::get('{unsigned_title}', "ClientCategoryController@get")->name('categoryDetail')->where('unsigned_title','^[a-z0-9-/+]{3,10000}$');

Route::get('{unsigned_title}_{id}.html', "ClientPostDetailController@getPostDetail")->name('postDetail')->where('unsigned_title','^[a-z0-9-/+.]{3,10000}$');
