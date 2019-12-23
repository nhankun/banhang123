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

//general manager
Route::prefix('back/general')->group(function () {
    //Providers
    Route::namespace('Backs\Providers')->group(function () {
        Route::prefix('providers')->group(function () {
            Route::post('/delete', 'ProviderController@delete')->name('providers.delete');
            Route::get('/search', 'ProviderController@search')->name('providers.search');
        });
        Route::resource('providers', 'ProviderController')->only(['index', 'store', 'create', 'edit', 'update']);
    });

    //categories
    Route::namespace('Backs\Categories')->group(function () {
        Route::resource('categories', 'CategoryController')->only(['index', 'store', 'create', 'edit', 'update']);
    });

    //Products
    Route::namespace('Backs\Products')->group(function () {
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
//manager
Route::prefix('manager')->group(function () {

    Route::get('/', function () {
        return redirect('/');
    });

    Route::namespace('Backs\Managers')->group(function () {

        Route::namespace('Categories')->group(function () {
            Route::prefix('categories')->group(function () {

                Route::get('/', 'ManagerCategoryController@index')->name('managerCategories.index');
                Route::post('/delete', 'ManagerCategoryController@delete')->name('managerCategories.delete');
                Route::get('/search', 'ManagerCategoryController@search')->name('managerCategories.search');

            });
        });

        Route::namespace('Providers')->group(function () {
            Route::prefix('providers')->group(function () {

                Route::get('/', 'ManagerProviderController@index')->name('managerProviders.index');
                Route::post('/delete', 'ManagerProviderController@delete')->name('managerProviders.delete');
                Route::get('/search', 'ManagerProviderController@search')->name('managerProviders.search');

            });
        });

    });

});
//admin
Route::prefix('admin')->group(function () {

    Route::namespace('Backs\Admins')->group(function () {

        Route::namespace('Categories')->group(function () {
            Route::prefix('categories')->group(function () {
                Route::get('/', 'AdminCategoryController@index')->name('AdminCategory.index');
                Route::delete('/destroy/{id}', 'AdminCategoryController@destroy')->name('AdminCategory.destroy');
                Route::post('/approved', 'AdminCategoryController@approved')->name('AdminCategory.approved');
                Route::post('/cancel', 'AdminCategoryController@cancel')->name('AdminCategory.cancel');
            });
        });

        Route::namespace('Providers')->group(function () {
            Route::prefix('providers')->group(function () {
                Route::get('/', 'AdminProviderController@index')->name('AdminProvider.index');
                Route::delete('/destroy/{id}', 'AdminProviderController@destroy')->name('AdminProvider.destroy');
                Route::post('/approved', 'AdminProviderController@approved')->name('AdminProvider.approved');
                Route::post('/cancel', 'AdminProviderController@cancel')->name('AdminProvider.cancel');
            });
        });

    });

});
