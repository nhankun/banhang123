<?php

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
    return view('backs.index');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('providers.index');
    });
    Route::namespace('Backs')->group(function () {

        Route::prefix('providers')->group(function () {
            Route::resource('providers', 'ProviderController')->only(['index', 'store', 'create', 'edit', 'update']);
            Route::post('/delete', 'ProviderController@delete')->name('providers.delete');
            Route::get('/search', 'ProviderController@search')->name('providers.search');
            Route::post('/approved', 'ProviderController@approved')->name('providers.approved');
            Route::post('/cancel', 'ProviderController@cancel')->name('providers.cancel');
        });

        //categories
        Route::prefix('categories')->group(function () {

            Route::resource('categories', 'CategoryController')->only(['index', 'store', 'create', 'edit', 'update']);
            Route::post('/delete', 'CategoryController@delete')->name('categories.delete');
            Route::get('/search', 'CategoryController@search')->name('categories.search');
            Route::post('/approved', 'CategoryController@approved')->name('categories.approved');
            Route::post('/cancel', 'CategoryController@cancel')->name('categories.cancel');

        });
    });
});
