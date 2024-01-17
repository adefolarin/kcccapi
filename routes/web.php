<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::prefix('/admin')->group(function(){
    Route::match(['get','post'],'/admin/login',[AdminController::class, 'login']);

    Route::group(['middleware'=>['admin']], function() {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
        Route::match(['get','post'],'/admin/update-password', [AdminController::class,'updatePassword']);
        Route::post('/admin/check-current-password', [AdminController::class,'checkCurrentPassword']);
        Route::match(['get','post'],'/admin/update-admin-details', [AdminController::class,'updateAdminDetails']);
        Route::get('/admin/logout', [AdminController::class,'logout']);

        // Display CMS Pages ( CRUD - READ)
        /*Route::get('/admin/cms-pages', [CmsController::class,'index']);
        Route::post('/admin/update-cms-page-status', [CmsController::class,'updatePageStatus']);
        Route::match(['get','post'],'/admin/add-edit-cms-page/{id?}', [CmsController::class,'edit']);
        Route::match(['get'],'/admin/delete-cms-page/{id?}', [CmsController::class,'destroy']);*/

        // Banner
        Route::get('/admin/banner', [BannerController::class,'index']);
        Route::get('/admin/banner-add', [BannerController::class,'create']);
        Route::post('/admin/banner-add', [BannerController::class,'store']);
        Route::match(['get'],'/admin/banner-edit/{id?}', [BannerController::class,'edit']);
        Route::match(['post'],'/admin/banner-edit/{id?}', [BannerController::class,'update']);
        Route::match(['post'],'/admin/banner-file-edit/{id?}', [BannerController::class,'updateBannerFile']);
        Route::match(['get'],'/admin/delete-banner/{id?}', [BannerController::class,'destroy']);
     
    });
//});
