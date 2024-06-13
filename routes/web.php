<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportDamagedProductController;
use App\Http\Controllers\ReportIncomingProductController;
use App\Http\Controllers\ReportReturningProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('report-incoming-products', ReportIncomingProductController::class)->except('delete', 'edit');
    Route::resource('report-damaged-products', ReportDamagedProductController::class)->except('create', 'store', 'delete', 'edit');
    Route::resource('report-returning-products', ReportReturningProductController::class)->only('index', 'show');
    Route::post('/update-status', [ReportReturningProductController::class, 'updateStatus'])->name('update.status');
    Route::get('/report-incoming-products/print/{id}', [ReportIncomingProductController::class, 'print'])->name('incoming.print');
    Route::get('/report-damaged-products/print/{id}', [ReportDamagedProductController::class, 'print'])->name('damaged.print');
    Route::get('/report-returning-products/print/{id}', [ReportReturningProductController::class, 'print'])->name('returning.print');
});
