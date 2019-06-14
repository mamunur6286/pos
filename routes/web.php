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



Route::get('/', 'HomeController@index');


    Auth::routes();



// route for permission access
Route::resource('users', 'UserController');
Route::get('user/import','UserController@import');
Route::get('user/export','UserController@export');

Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');


Route::resource('categories','CategoryController')->middleware('auth');
Route::get('category/import','CategoryController@import')->middleware('auth');
Route::post('category/excel/store','CategoryController@importStore')->middleware('auth');
Route::get('category/export','CategoryController@export')->middleware('auth');


Route::resource('items','ItemController')->middleware('auth');
Route::get('item/import','ItemController@import')->middleware('auth');
Route::post('item/excel/store','ItemController@importStore')->middleware('auth');
Route::get('item/export','ItemController@export')->middleware('auth');

Route::resource('customers','CustomerController')->middleware('auth');
Route::get('customer/import','CustomerController@import')->middleware('auth');
Route::post('customer/excel/store','CustomerController@importStore')->middleware('auth');
Route::get('customer/export','CustomerController@export')->middleware('auth');

Route::resource('suppliers','SupplierController')->middleware('auth');
Route::get('supplier/import','SupplierController@import')->middleware('auth');
Route::post('supplier/excel/store','SupplierController@importStore')->middleware('auth');
Route::get('supplier/export','SupplierController@export')->middleware('auth');


Route::resource('units','UnitController')->middleware('auth');
Route::get('unit/import','UnitController@import')->middleware('auth');
Route::post('unit/excel/store','UnitController@importStore')->middleware('auth');
Route::get('unit/export','UnitController@export')->middleware('auth');

Route::resource('invoices','InvoiceController')->middleware('auth');
Route::get('/getPrice','InvoiceController@getPrice')->middleware('auth');
Route::get('/print/invoice/{id}','InvoiceController@pdfInvoice')->middleware('auth');

Route::get('invoice/import','InvoiceController@import')->middleware('auth');
Route::post('invoice/excel/store','InvoiceController@importStore')->middleware('auth');
Route::get('invoice/export','InvoiceController@export')->middleware('auth');



Route::post('/sales/update/{id}','PriceController@updateSalesPrice')->middleware('auth');
Route::post('/purchase/update/{id}','PriceController@updatePurchasePrice')->middleware('auth');


Route::resource('purchases','PurchaseController')->middleware('auth');
Route::get('/getPrice','PurchaseController@getPrice')->middleware('auth');
Route::get('/print/purchase/{id}','PurchaseController@pdfPurchase')->middleware('auth');

Route::get('purchase/import','PurchaseController@import')->middleware('auth');
Route::post('purchase/excel/store','PurchaseController@importStore')->middleware('auth');
Route::get('purchase/export','PurchaseController@export')->middleware('auth');
