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

Route::match(['get', 'post'], '/', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::group(['prefix' => 'jurusan'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\JurusanController::class, 'index'])->name('jurusan.index');
    Route::get('/tambah', [\App\Http\Controllers\Admin\JurusanController::class, 'add_page'])->name('jurusan.add_page');
    Route::post('/create', [\App\Http\Controllers\Admin\JurusanController::class, 'create'])->name('jurusan.create');
    Route::get('/edit/{id}', [\App\Http\Controllers\Admin\JurusanController::class, 'create'])->name('jurusan.edit');
    Route::post('/patch', [\App\Http\Controllers\Admin\JurusanController::class, 'patch'])->name('jurusan.patch');
});
