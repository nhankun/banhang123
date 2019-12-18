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

        Route::namespace('Providers')->group(function () {
            Route::prefix('providers')->group(function () {
                Route::post('/delete', 'ProviderController@delete')->name('providers.delete');
                Route::get('/search', 'ProviderController@search')->name('providers.search');
                Route::post('/approved', 'ProviderController@approved')->name('providers.approved');
                Route::post('/cancel', 'ProviderController@cancel')->name('providers.cancel');
            });
            Route::resource('providers', 'ProviderController')->only(['index', 'store', 'create', 'edit', 'update']);
        });

        //categories
        Route::namespace('Categories')->group(function () {
            Route::prefix('categories')->group(function () {
                Route::post('/delete', 'CategoryController@delete')->name('categories.delete');
                Route::get('/search', 'CategoryController@search')->name('categories.search');
                Route::post('/approved', 'CategoryController@approved')->name('categories.approved');
                Route::post('/cancel', 'CategoryController@cancel')->name('categories.cancel');
                Route::post('/delete-property-default', 'CategoryController@deletePropertyDefault')->name('categories.deletePropertyDefault');
            });
            Route::resource('categories', 'CategoryController')->only(['index', 'store', 'create', 'edit', 'update']);
        });

        //Products
        Route::namespace('Products')->group(function () {
            Route::prefix('products')->group(function () {

                Route::post('/delete', 'ProductController@delete')->name('products.delete');
                Route::get('/search', 'ProductController@search')->name('products.search');
                Route::post('/approved', 'ProductController@approved')->name('products.approved');
                Route::post('/cancel', 'ProductController@cancel')->name('products.cancel');

                Route::post('image/delete/{id}', 'ImageController@delete')->name('images.delete');
                Route::resource('images', 'ImageController')->only(['index', 'store', 'create', 'edit', 'update']);

                Route::post('property/delete', 'PropertyController@delete')->name('property.delete');
                Route::get('property/edit-by-product/{product_id}', 'PropertyController@editByProduct')->name('property.editByProduct');
                Route::put('property/update-by-product/{product_id}', 'PropertyController@updateByProduct')->name('property.updateByProduct');
                Route::resource('properties', 'PropertyController')->only(['index', 'store', 'create', 'edit', 'update']);

                Route::get('index', 'ManagerProductController@index')->name('managerProduct.index');
                Route::post('approved', 'ManagerProductController@approved')->name('managerProduct.approved');
                Route::post('cancel', 'ManagerProductController@cancel')->name('managerProduct.cancel');
            });
            Route::resource('products', 'ProductController')->only(['index', 'store', 'create', 'edit', 'update']);
        });

    });
});
