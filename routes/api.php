<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

/**  ADMIN ENDPOINS */
Route::group(['prefix' => 'admin', 'middleware' => ['auth:api', 'role:admin']], function () {

    Route::get('departments', 'Admin\AdminController@departments')->name('admin.departments');

    Route::get('staffs', 'Admin\AdminController@staffs')->name('admin.staffs');
    
    Route::post('create/staff', 'Admin\AdminController@createstaff')->name('admin.create.staff');
    
    Route::post('create/department', 'Admin\AdminController@createdepartment')->name('admin.create.department');

    Route::get('staff/deactivate/{id}', 'Admin\AdminController@staffdeactivate')->name('admin.staff.deactivate');

});


/**  STAFF ENDPOINS */
Route::group(['prefix' => 'staff', 'middleware' => ['auth:api', 'role:staff']], function () {

    Route::get('/departments', 'Staff\StaffController@departments')->name('staff.departments');

    Route::get('user', 'Staff\StaffController@getuser')->name('get.user');

    Route::post('/update', 'Staff\StaffController@updateuser')->name('upate.user');

});
