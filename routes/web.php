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
Route::get('/debug', function () {
    return view('debug');
});

Route::get('/', [\App\Http\Controllers\Data\HomeController::class,'dashboard'])->name('dashboard');


includeRouteFiles(__DIR__.'/Data/');


