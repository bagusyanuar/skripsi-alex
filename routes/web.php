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
    Route::get('/edit/{id}', [\App\Http\Controllers\Admin\JurusanController::class, 'edit_page'])->name('jurusan.edit');
    Route::post('/patch', [\App\Http\Controllers\Admin\JurusanController::class, 'patch'])->name('jurusan.patch');
    Route::post('/destroy', [\App\Http\Controllers\Admin\JurusanController::class, 'destroy'])->name('jurusan.destroy');
});

Route::group(['prefix' => 'kelas'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\KelasController::class, 'index'])->name('kelas.index');
    Route::get('/tambah', [\App\Http\Controllers\Admin\KelasController::class, 'add_page'])->name('kelas.add_page');
    Route::post('/create', [\App\Http\Controllers\Admin\KelasController::class, 'create'])->name('kelas.create');
    Route::get('/edit/{id}', [\App\Http\Controllers\Admin\KelasController::class, 'edit_page'])->name('kelas.edit');
    Route::post('/patch', [\App\Http\Controllers\Admin\KelasController::class, 'patch'])->name('kelas.patch');
    Route::post('/destroy', [\App\Http\Controllers\Admin\KelasController::class, 'destroy'])->name('kelas.destroy');
});

Route::group(['prefix' => 'ruangan'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\RuanganController::class, 'index'])->name('ruangan.index');
    Route::get('/tambah', [\App\Http\Controllers\Admin\RuanganController::class, 'add_page'])->name('ruangan.add_page');
    Route::post('/create', [\App\Http\Controllers\Admin\RuanganController::class, 'create'])->name('ruangan.create');
    Route::get('/edit/{id}', [\App\Http\Controllers\Admin\RuanganController::class, 'edit_page'])->name('ruangan.edit');
    Route::post('/patch', [\App\Http\Controllers\Admin\RuanganController::class, 'patch'])->name('ruangan.patch');
    Route::post('/destroy', [\App\Http\Controllers\Admin\RuanganController::class, 'destroy'])->name('ruangan.destroy');
});

Route::group(['prefix' => 'sarana'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\SaranaController::class, 'index'])->name('sarana.index');
    Route::get('/tambah', [\App\Http\Controllers\Admin\SaranaController::class, 'add_page'])->name('sarana.add_page');
    Route::post('/create', [\App\Http\Controllers\Admin\SaranaController::class, 'create'])->name('sarana.create');
    Route::get('/edit/{id}', [\App\Http\Controllers\Admin\SaranaController::class, 'edit_page'])->name('sarana.edit');
    Route::post('/patch', [\App\Http\Controllers\Admin\SaranaController::class, 'patch'])->name('sarana.patch');
    Route::post('/destroy', [\App\Http\Controllers\Admin\SaranaController::class, 'destroy'])->name('sarana.destroy');
});

Route::group(['prefix' => 'persediaan'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\StockController::class, 'index'])->name('stock.index');
});

Route::group(['prefix' => 'persediaan-keluar'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\StockKeluarController::class, 'index'])->name('stock.keluar.index');
    Route::match(['post', 'get'],'/{id}/detail', [\App\Http\Controllers\Admin\StockKeluarController::class, 'detail'])->name('stock.keluar.detail');
    Route::get('/data', [\App\Http\Controllers\Admin\StockKeluarController::class, 'data_page'])->name('stock.keluar.data');
});

Route::group(['prefix' => 'persediaan-masuk'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\StockMasukController::class, 'index'])->name('stock.masuk.index');
    Route::match(['post', 'get'],'/{id}/detail', [\App\Http\Controllers\Admin\StockMasukController::class, 'detail'])->name('stock.masuk.detail');
    Route::get('/data', [\App\Http\Controllers\Admin\StockMasukController::class, 'data_page'])->name('stock.masuk.data');
});
