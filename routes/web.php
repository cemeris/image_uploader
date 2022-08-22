<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/image_upload', function () {
    return view('upload_form');
});

use App\Http\Controllers\StoreSomeValueController;
Route::get('/store_some_value', [StoreSomeValueController::class, 'storeText']);
Route::get('/store_some_value/{text}', [StoreSomeValueController::class, 'storeText']);

Route::get('/get_some_value', [StoreSomeValueController::class, 'getText']);
