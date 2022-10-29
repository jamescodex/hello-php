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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

/**  ADMIN WEB ENDPOINS */
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {

    Route::get('/create/department', 'HomeController@createdepartment')->name('admin.create.department');

    Route::get('/dashboard', 'HomeController@admindashboard')->name('admin.dashboard');

    Route::get('/staffs', 'HomeController@adminstaffs')->name('admin.staffs');

    Route::get('/create/staff', 'HomeController@createstaff')->name('admin.create.staff');

});




/**  STAFF ENDPOINS */
Route::group(['prefix' => 'staff', 'middleware' => ['auth', 'role:staff']], function () {

    Route::get('/departments', 'HomeController@departments')->name('departments');

    Route::get('/dashboard', 'HomeController@staffdashboard')->name('staffdashboard');

});

