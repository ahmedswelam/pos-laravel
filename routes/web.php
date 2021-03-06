<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pos;

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


Route::post('home/{id}', [pos::class, 'AddToCart']);
Route::get('home/cart', [pos::class, 'myCart']);
Route::get('home/clear/{id}', [pos::class, 'deleteOne'])->name('delete');
Route::get('home/remove/{id}', [pos::class, 'removeItem'])->name('remove');


