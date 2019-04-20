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
    return redirect()->route('login');
});
Route::get('/register', function () {
    return redirect()->route('login');
});
Auth::routes(['register' => false]);


Route::group(['middleware' => 'auth'], function () {
Route::get('dashboard', 'HomeController@index')->name('home');
    //staff
    Route::get('/staff', 'AdminController@staffIndex')->name('staff.index');
    Route::get('/staff/add', 'AdminController@staffAdd')->name('staff.add');
    Route::post('/staff/add', 'AdminController@staffStore')->name('staff.store');
    Route::get('/staff/{id}', 'AdminController@staffEdit')->name('staff.edit');
    Route::PATCH('/staff/{staff}', 'AdminController@staffUpdate')->name('staff.update');
    Route::get('/delete/{staff}', 'AdminController@staffDelete')->name('staff.delete');
    //admin add item type
    Route::get('/admin/type', 'AdminController@typeIndex')->name('admin.type.index');
    Route::get('/admin/type/add', 'AdminController@typeAdd')->name('admin.type.add');
    Route::post('/admin/type/add', 'AdminController@typeStore')->name('admin.type.store');
    Route::get('/admin/type/{type}', 'AdminController@typeEdit')->name('admin.type.edit');
    Route::PATCH('/admin/type/{type}', 'AdminController@typeUpdate')->name('admin.type.update');
    Route::get('/admin/type/remove/{id}', 'AdminController@typeDelete')->name('admin.type.destroy');
    //admin add item
    Route::get('/admin/items', 'AdminController@itemIndex')->name('admin.items.index');
    Route::get('/admin/item/add', 'AdminController@itemAdd')->name('admin.item.add');
    Route::post('/admin/item/add', 'AdminController@itemStore')->name('admin.item.store');
    Route::get('/admin/item/{item}', 'AdminController@itemEdit')->name('admin.item.edit');
    Route::PATCH('/admin/item/{item}', 'AdminController@itemUpdate')->name('admin.item.update');
    Route::get('/admin/delete/{item}', 'AdminController@itemDelete')->name('admin.item.delete');
    Route::POST('/admin/item/search', 'AdminController@itemSearch')->name('admin.item.search');
    //admin
    Route::get('/branch', 'AdminController@branchIndex')->name('branch.index');
    Route::get('/branch/add', 'AdminController@branchAdd')->name('branch.add');
    Route::post('/branch/add', 'AdminController@branchStore')->name('branch.store');
    Route::get('/branch/{branch}', 'AdminController@branchEdit')->name('branch.edit');
    Route::PATCH('/branch/{branch}', 'AdminController@branchUpdate')->name('branch.update');
    Route::get('/remove/{id}', 'AdminController@branchDelete')->name('branch.destroy');
    // Admin Report
    Route::get('/admin/report', 'AdminController@adminReport')->name('admin.report');
    Route::POST('/admin/report/generate', 'AdminController@adminReportGenerate')->name('admin.report.generate');
    // Summary
    Route::get('/branch/summary/{id}', 'AdminController@summary')->name('admin.summary');
    // Summary Generate PDF
    Route::get('/summary/generate_pdf/{id}','AdminController@summaryPDF')->name('summary.pdf');
    // Item type
    Route::get('/type', 'StaffController@typeIndex')->name('type.index');
    Route::get('/type/add', 'StaffController@typeAdd')->name('type.add');
    Route::post('/type/add', 'StaffController@typeStore')->name('type.store');
    // Route::get('/type/{type}', 'StaffController@typeEdit')->name('type.edit');
    // Route::PATCH('/type/{type}', 'StaffController@typeUpdate')->name('type.update');
    // Route::get('/type/remove/{id}', 'StaffController@typeDelete')->name('type.destroy');
    // Item
    Route::get('/items', 'StaffController@itemIndex')->name('items.index');
    Route::get('/item/add', 'StaffController@itemAdd')->name('item.add');
    Route::post('/item/add', 'StaffController@itemStore')->name('item.store');
    // Route::get('/item/{item}', 'StaffController@itemEdit')->name('item.edit');
    // Route::PATCH('/item/{item}', 'StaffController@itemUpdate')->name('item.update');
    // Route::get('/delete/{item}', 'StaffController@itemDelete')->name('item.delete');
    Route::POST('/item/search', 'StaffController@itemSearch')->name('item.search');
    // Report
    Route::get('/report', 'StaffController@reportIndex')->name('report.index');
    Route::POST('/report/generate', 'StaffController@reportGenerate')->name('report.generate');
    Route::get('password/reset', 'HomeController@reset')->name('reset');
    Route::POST('password/reset/verify', 'HomeController@verify')->name('verify_pass');
    Route::POST('password/update', 'HomeController@updatepass')->name('update_pass');
    Route::get('/profile', 'HomeController@showprofile')->name('profile');
    // Route::get('/logs', 'AdminController@logsIndex')->name('logs.index');
    // Route::get('/generate_pdf','StaffController@generatePDF')->name('generate_pdf');
});
