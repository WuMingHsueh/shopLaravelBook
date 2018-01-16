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

Route::get('/', 'WelcomeCtrl@index');

Route::get('/test', function () {
    return view('welcome');
});

Route::group(['prefix' => 'user'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::get('/sign-up', 'UserAuthController@signUpPage');
        Route::post('/sign-up', 'UserAuthController@signUpProcess');
        Route::get('/sign-in', 'UserAuthController@signInPage');
        Route::post('/sign-in', 'UserAuthController@signInProcess');
        Route::get('/sign-out', 'UserAuthController@signOutProcess');
    });
});

// 商品
Route::group(['prefix' => 'merchandise'], function() {
    Route::get('/', 'MerchandiseController@merchandiseListPage');
    Route::get('/create', 'MerchandiseController@merchandiseCreateProcess');
    Route::get('/mangae', 'MerchandiseController@merchandiseManageListPage');
    
    Route::group(['prefix' => '{merchandise_id}'], function() {
        Route::get('/', 'MerchandiseController@merchandiseItemPage');
        Route::put('/', 'MerchandiseController@merchandiseItemUpdateProces');
        Route::get('/edit', 'MerchandiseController@merchandiseItemEditPage');
        Route::post('/buy', 'MerchandiseController@merchandiseItemBuyProcess');
    });
});
