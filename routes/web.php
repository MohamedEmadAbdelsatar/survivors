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
Route::get('contactus', function(){
    return view('admin.contact.contactus');
})->name('contactus');
Route::post('contact/save','ContactController@savecontact')->name('contact/save');
Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('orders/pending','OrdersController@show_pending')->name('orders/pending');
    Route::get('orders/accepted','OrdersController@show_accepted')->name('orders/accepted');
    Route::get('orders/refused','OrdersController@show_refused')->name('orders/refused');
    Route::post('orders/action','OrdersController@pending_action')->name('orders/action');
    Route::get('blood/modify/{hospital_id}','BloodController@modify_amounts')->name('blood/modify');
    Route::post('blood/update','BloodController@store_mod')->name('blood/update');
    Route::get('about/modify','AboutController@modify')->name('about/modify');
    Route::post('about/update','AboutController@save')->name('about/update');
    Route::get('hospital/orders','OrdersController@hospital_orders')->name('hospital/orders');
    Route::resource('hospital','HospitalController');
    Route::resource('admins','AdminController');
    Route::resource('orders','OrdersController');
    Route::get('contacts','ContactController@index')->name('contacts');
    Route::post('contact/delete','ContactController@delete')->name('contact/delete');
});

