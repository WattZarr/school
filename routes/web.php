<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']],function(){
    Route::get('logout','Auth\LoginController@logout')->name('logout');

    //user
    Route::get('user_home','UserController@index')->name('user_homepage');
    Route::get('contact_page','UserController@contact_page')->name('contact_page');
    Route::get('user_profile','UserController@user_profile')->name('user_profile');
    Route::get('look_newInfo/{id}','UserController@look_newInfo')->name('look_newInfo');
    Route::get('delete_news/{id}','UserController@delete_news')->name('delete_news')->middleware('checkPremium');
    Route::post('update_news','UserController@update_news')->name('update_news')->middleware('checkPremium');
    Route::post('update_account','UserController@update_account')->name('update_account');
    Route::post('change_password','UserController@change_password')->name('change_password');
    //Create News
    Route::post('insert_news','UserController@insert_news')->name('insert_news');
    //Create Contact
    Route::post('insert_contact','UserController@insert_contact')->name('insert_contact');

    Route::group(['middleware' =>['checkAdmin']],function(){
        //admin
        Route::get('admin_page','AdminController@index')->name('admin_page');
        Route::get('admin_profile','AdminController@admin_profile')->name('admin_profile');
        Route::get('user_account','AdminController@user_account')->name('user_account');
        Route::get('manage_premium','AdminController@manage_premium')->name('manage_premium');
        Route::get('admin_contact','AdminController@admin_contact')->name('admin_contact');
        Route::get('delete_contact/{id}','AdminController@delete_contact')->name('delete_contact');
        Route::get('update_contact_page/{id}','AdminController@update_contact_page')->name('update_contact_page');
        Route::post('update_contact','AdminController@update_contact')->name('update_contact');
        Route::get('delete_user/{id}','AdminController@delete_user')->name('delete_user');
        Route::get('update_user_page/{id}','AdminController@update_user_page')->name('update_user_page');
        Route::post('update_user','AdminController@update_user')->name('update_user');
        Route::post('update_admin_info','AdminController@update_admin_info')->name('update_admin_info');
        Route::post('update_admin_password','AdminController@update_admin_password')->name('update_admin_password');

    });
    
});

