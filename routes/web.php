<?php

use Illuminate\Support\Facades\Route;

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

Route::get('login' ,'Authentication@login_get')->name('login');
Route::post('login' ,'Authentication@login_post');
Route::get('logout' ,'Authentication@logout')->name('logout');

Route::group(['middleware' => 'auth'] ,function () {
    Route::get('/' ,'ExpensesController@index')->name('expenses.index');
    Route::post('/create' ,'ExpensesController@store')->name('expenses.store')->middleware('employee-role');
    Route::get('/cancel/{expense_id}' ,'ExpensesController@cancel')->name('expenses.cancel')->middleware('employee-role');
    Route::get('/approve/{expense_id}' ,'ExpensesController@approve')->name('expenses.approve')->middleware('manager-role');
    Route::get('/reject/{expense_id}' ,'ExpensesController@reject')->name('expenses.reject')->middleware('manager-role');
});
