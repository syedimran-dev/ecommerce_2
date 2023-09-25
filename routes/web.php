<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('/admin')->namespace(App\Http\Controllers\Admin::class)->group(function(){
    Route::match(['get', 'post'], 'login', 'AdminController@login');
    Route::group(['middleware' => ['admin']], function(){
        Route::get('dashboard', 'AdminController@dashboard');
        Route::match(['get', 'post'], 'update-password', 'AdminController@updatePassword');
        Route::match(['get', 'post'], 'update-details', 'AdminController@updateAdminDetails');
        Route::post('check-current-password', 'AdminController@checkCurrentPassword');
        Route::get('logout', 'AdminController@logout');

        #CMS Page Resources
        Route::resource('cms-pages', CmsController::class);
        Route::post('update-cms-pages-status', 'CmsController@update');
        Route::match(['post', 'get'], 'add-edit-cms-page/{id?}', 'CmsController@edit');
        Route::get('delete-cms-page/{id?}', 'CmsController@destroy');

        #Sub-Admins Resources
        Route::get('subadmins', 'AdminController@subAdmins');
        Route::post('update-subadmin-status', 'AdminController@updateSubAdminStatus');
        Route::get('delete-subadmin/{id?}', 'AdminController@destroy');
        Route::match(['post', 'get'], 'add-edit-subadmin/{id?}', 'AdminController@edit');
        Route::match(['post', 'get'], 'update-role/{id}', 'AdminController@updateRole');

        #Categories
        Route::get('categories', 'CategoryController@categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        Route::get('delete-category/{id?}', 'CategoryController@destroy');
        Route::match(['post', 'get'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
    });
});

