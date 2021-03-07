<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user_login' ,'Authentication@api_login');

Route::group(['prefix' => 'expenses' ,'namespace' => 'Api'] ,function() {
    Route::get('/' ,'ExpenseApiController@index')
        ->name('expenses.api_index')
        ->middleware(['user-api-access']);

    Route::get('/{id}' ,'ExpenseApiController@show')
        ->name('expenses.api_show')
        ->middleware(['user-api-access']);

    Route::post('/create' ,'ExpenseApiController@create')
        ->name('expenses.api_create')
        ->middleware(['employee-api-access']);

    Route::patch('/{id}/cancel' ,'ExpenseApiController@cancel')
        ->name('expenses.api_cancel')
        ->middleware('employee-api-access');

    Route::patch('/{id}/approve' ,'ExpenseApiController@approve')
        ->name('expenses.api_approve')
        ->middleware('manager-api-access');

    Route::patch('/{id}/reject' ,'ExpenseApiController@reject')
        ->name('expenses.api_reject')
        ->middleware('manager-api-access');
});