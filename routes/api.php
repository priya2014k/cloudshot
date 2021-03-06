<?php

use Illuminate\Http\Request;

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


Route::group(['middleware' => ['api']], function () {
    Route::post('login', 'UserController@login');
    Route::post('userlogin', 'UserController@userlogin');
    Route::post('register', 'UserController@registration');
    Route::post('resend', 'UserController@resendotp');
    Route::post('verifyotp', 'UserController@verifyotp');
    
    Route::get('getroles', 'AdminUserController@getroles');
    Route::get('getallusers', 'AdminUserController@getallusers');
    Route::post('adduser', 'AdminUserController@adduser');
    Route::post('changeuserstatus', 'AdminUserController@changeuserstatus');

    //category
    Route::get('getcategory/', 'CategoryController@getcategory');
    Route::get('getsubcategory/', 'CategoryController@getsubcategory');
    Route::post('/getallcategory/', 'CategoryController@getallcategory');
    Route::post('addcategory/', 'CategoryController@addcategory');
    Route::post('/addsubcategory/', 'CategoryController@addsubcategory');
    Route::post('/getallsubcategory/', 'CategoryController@getallsubcategory');
    Route::post('categorypic/', 'CategoryController@categorypic');

    //trans
    Route::post('/categorysubcategory/', 'CategoryController@categorysubcategorytransaction');

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('user', 'UserController@getAuthUser');
    });
});