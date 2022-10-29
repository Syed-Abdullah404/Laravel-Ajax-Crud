<?php
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[ProductsController::class,'index']);
Route::get('/table',[ProductsController::class,'table']);
Route::post('/getModel',[ProductsController::class,'getModel']);
Route::post('/getModel2',[ProductsController::class,'getModel2']);
Route::post('/store',[ProductsController::class,'store'])->name('store');
Route::get('/fetchall', [ProductsController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete',[ProductsController::class, 'delete'])->name('delete');
Route::get('/edit',[ProductsController::class, 'edit'])->name('edit');
Route::post('/update',[ProductsController::class, 'update'])->name('update');


// brand

Route::get('/brand',[BrandController::class,'brand']);
Route::post('/storebrand',[ProductsController::class,'storebrand'])->name('storebrand');