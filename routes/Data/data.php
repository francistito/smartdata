<?php

Route::group([
    'namespace' => 'Data',

], function() {
    Route::group([ 'prefix' => 'data',  'as' => 'data.'], function() {
        Route::get('/index', [\App\Http\Controllers\Data\DataController::class,'index'])->name('index');
        Route::get('/upload', [\App\Http\Controllers\Data\DataController::class,'upload'])->name('upload');
        Route::post('/store_uploaded_data', [\App\Http\Controllers\Data\DataController::class,'storeUploadedData'])->name('store_uploaded_data');
        Route::get('/get_all_for_dt', [\App\Http\Controllers\Data\DataController::class,'getAllForDt'])->name('get_all_for_dt');
        Route::post('/dashboard', [\App\Http\Controllers\Data\DataController::class,'dashboard'])->name('dashboard');
    });
});
