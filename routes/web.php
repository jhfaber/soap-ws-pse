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

/*
|--------------------------------------------------------------------------
| Authentication routes
|--------------------------------------------------------------------------
|
 */
Auth::routes();

/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
|
 */
Route::get('/', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Payment Cycle Routes
|--------------------------------------------------------------------------
|
 */
Route::get('/payment', 'SoapController@create')->name('payment');
Route::post('/payment', 'SoapController@store')->name('pay');

/*
|--------------------------------------------------------------------------
| Transactions management Routes
|--------------------------------------------------------------------------
|
 */
Route::get('/transaction/{reference}', 'SoapController@show')->name('transaction');
