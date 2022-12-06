<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::group(['prefix' => 'admin', 'middleware' => ['jwt.verify']], function () {

    Route::group(['prefix' => 'ruangan'], function () {
        Route::get('/', [\App\Http\Controllers\Api\Admin\RuanganController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\Api\Admin\RuanganController::class, 'detail']);
        Route::get('/{id}/sarana', [\App\Http\Controllers\Api\Admin\RuanganController::class, 'available_stocks']);
        Route::post('/{id}/sarana/add', [\App\Http\Controllers\Api\Admin\RuanganController::class, 'add_item']);
        Route::match(['post', 'get'],'/{id}/sarana/keluar', [\App\Http\Controllers\Api\Admin\StockKeluarController::class, 'index']);
        Route::match(['post', 'get'],'/{id}/sarana/masuk', [\App\Http\Controllers\Api\Admin\StockMasukController::class, 'index']);
    });


});
