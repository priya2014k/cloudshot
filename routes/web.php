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
    return view('welcome');
});
Route::get('/login', function () {
	    return view('auth.login');
	})->name('login');
Route::get('dashboard', function () {return view('users.admin.dashboard');})->name('admin.dashboard');
Route::get('manageusers', function () {return view('users.admin.manageusers');})->name('admin.manageusers');

//category management
	Route::get('/managecategory', function () {
	    return view('users.admin.managecategory');
	})->name('managecategory');

	Route::get('/categorypermission', function () {
	    return view('users.admin.categorypermission');
	})->name('categorypermission');
