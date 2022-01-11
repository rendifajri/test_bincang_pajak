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
$path = "App\\Http\\Controllers\\";

Route::get ('item', [$path."ItemController", 'index']);
Route::get ('destination', [$path."DestinationController", 'index']);

Route::get ('invoice', [$path."InvoiceController", 'index']);
Route::get ('invoice/detail/{id}', [$path."InvoiceController", 'detail']);
Route::post('invoice', [$path."InvoiceController", 'create']);
Route::post('invoice/update/{id}', [$path."InvoiceController", 'update']);
