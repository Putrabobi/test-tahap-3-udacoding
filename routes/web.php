<?php

use App\Http\Controllers\PaketLaundryController;
use App\Http\Controllers\SatuanController;
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
    return view('dashboard');
});

Route::controller(SatuanController::class)
    ->prefix('satuan')
    ->group(function(){
        Route::get('/', 'index')->name('satuan');
        Route::get('create', 'create')->name('satuan.create');
        Route::post('store', 'store')->name('satuan.store');
        Route::put('edit/{id}', 'update')->name('satuan.update');
        Route::put('changeStatus/{id}', 'changeStatus')->name('satuan.changeStatus');
        Route::delete('destroy/{id}', 'destroy')->name('satuan.destroy');     
});

Route::controller(PaketLaundryController::class)
    ->prefix('paket-laundry')
    ->group(function(){
        Route::get('/', 'index')->name('paket');
        Route::get('create', 'create')->name('paket.create');
        Route::post('store', 'store')->name('paket.store');
        Route::put('edit/{id}', 'update')->name('paket.update');
        Route::put('changeStatus/{id}', 'changeStatus')->name('paket.changeStatus');
        Route::delete('destroy/{id}', 'destroy')->name('paket.destroy');     
});
