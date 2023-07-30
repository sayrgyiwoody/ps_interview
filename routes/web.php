<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\AdminHomeController;

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

Route::get('/', function () {
    return redirect()->route('login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'user','middleware'=>['auth','user_auth']],function(){
    Route::get('/home',[UserHomeController::class,'home'])->name('user.home');
    Route::get('detail/{id}',[UserHomeController::class,'detail'])->name('user.detail');
    Route::get('categoryFilter/{id}',[UserHomeController::class,'categoryFilter'])->name('user.categoryFilter');
    Route::post('filter',[UserHomeController::class,'filter'])->name('user.filter');
});

Route::group(['prefix'=>'admin','middleware'=>['auth','admin_auth']],function(){
    Route::get('/home',[AdminHomeController::class,'home'])->name('admin.home');
    Route::group(['prefix'=>'category'],function(){
        Route::get('/',[CategoryController::class,'list'])->name('admin.category.list');
        Route::get('create',[CategoryController::class,'createPage'])->name('admin.category.createPage');
        Route::post('create',[CategoryController::class,'create'])->name('admin.category.create');
        Route::get('editPage/{id}',[CategoryController::class,'editPage'])->name('admin.category.editPage');
        Route::post('edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('admin.category.delete');
        Route::post('changeStatus',[CategoryController::class,'changeStatus'])->name('admin.category.changeStatus');
    });
    Route::group(['prefix'=>'item'],function(){
        Route::get('/',[ItemController::class,'list'])->name('admin.item.list');
        Route::get('create',[ItemController::class,'createPage'])->name('admin.item.createPage');
        Route::post('create',[ItemController::class,'create'])->name('admin.item.create');
        Route::get('editPage/{id}',[ItemController::class,'editPage'])->name('admin.item.editPage');
        Route::post('edit/{id}',[ItemController::class,'edit'])->name('admin.item.edit');
        Route::get('delete/{id}',[ItemController::class,'delete'])->name('admin.item.delete');
        Route::post('changeStatus',[ItemController::class,'changeStatus'])->name('admin.item.changeStatus');
    });
});
