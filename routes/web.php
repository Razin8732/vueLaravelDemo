<?php

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
Route::get('/bouquets', [HomeController::class, 'bouquets'])->name('bouquets');
Route::get('bouquets/{bouquetId}', [HomeController::class, 'get'])->name('getBouquets');
Route::delete('bouquets/{bouquetId}', [HomeController::class, 'delete'])->name('deleteBouquets');
