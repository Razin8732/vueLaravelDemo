<?php

use App\Http\Controllers\BouquetController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/bouquets', [BouquetController::class, 'index'])->name('bouquets.index');
Route::get('bouquets/{bouquetId}', [BouquetController::class, 'show'])->name('bouquets.show');
Route::post('/bouquets', [BouquetController::class, 'store'])->name('bouquets.store');
Route::delete('bouquets/{bouquetId}', [BouquetController::class, 'delete'])->name('bouquets.delete');
