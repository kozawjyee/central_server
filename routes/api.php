<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeskeraController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('deskera', [DeskeraController::class, 'index']);
Route::get('deskera/sale-invoice', [InvoiceController::class, 'getInvoice']);
Route::get('deskera/customers', [CustomerController::class, 'getCustomerData']);