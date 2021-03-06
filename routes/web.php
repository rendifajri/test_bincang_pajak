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
$path = "App\\Http\\Controllers\\";

Route::get('/', [$path."WebInvoiceController", 'index']);
Route::get('/create', [$path."WebInvoiceController", 'create']);
Route::get('/update/{id}', [$path."WebInvoiceController", 'update']);
Route::get('/detail/{id}', [$path."WebInvoiceController", 'detail']);
Route::get('/delete/{id}', [$path."WebInvoiceController", 'delete']);
