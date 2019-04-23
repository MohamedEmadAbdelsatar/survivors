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
use App\About;
Route::get('/', function () {
    $about = About::find(1);
    return view('user.post',compact('about'));
});

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('hospital','HospitalController');
    Route::resource('admins','AdminController');
    Route::resource('orders','OrdersController');
    Route::get('pending_orders','OrdersController@show_pending')->name('pending_orders');
    Route::post('pending_action','OrdersController@pending_action')->name('pending_action');
    Route::get('modify_blood','BloodController@modify_amounts')->name('modify_blood');
    Route::post('store_mod','BloodController@store_mod')->name('store_mod');
    Route::get('modify_about','AboutController@modify')->name('modify_about');
    Route::post('save_about','AboutController@save')->name('save_about');
});

