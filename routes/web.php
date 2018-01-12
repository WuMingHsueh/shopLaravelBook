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
    });
});

// 商品
Route::get('/merchandise', 'MerchandiseController@merchandiseListPage');
Route::get('/merchandise/create', 'MerchandiseController@merchandiseCreateProcess');
Route::get('/merchandise/manage', 'MerchandiseController@merchandiseManageListPage');
Route::get('/merchandise/{merchandise_id}', 'MerchandiseController@merchandiseItemPage');
Route::get('/merchandise/{merchandise_id}/edit', 'MerchandiseController@merchandiseItemEditPage');
Route::put('/merchandise/{merchandise_id}', 'MerchandiseController@merchandiseItemUpdateProcess');
Route::post('/merchandise/{merchandise_id}/buy', 'MerchandiseController@merchandiseItemBuyProcess');
