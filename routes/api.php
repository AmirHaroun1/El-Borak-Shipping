<?php

use App\Http\Controllers\ApiControllers\AdminCustomerController;
use App\Http\Controllers\ApiControllers\CustomerInBoundShipmentController;
use App\Http\Controllers\ApiControllers\CustomerItemController;
use App\Http\Controllers\ApiControllers\CustomerOutBoundShipmentController;
use App\Http\Controllers\ApiControllers\DocumentsController;
use App\Http\Controllers\ApiControllers\ShipmentDocumentsController;
use App\Http\Controllers\ApiControllers\ShipmentItemsController;
use App\Http\Controllers\scantum\AuthController;
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


Route::name('api.')->middleware('auth:sanctum')->group(function () {
    Route::post('/login',[AuthController::class,'login']);

    Route::apiResource('/admin/customers',AdminCustomerController::class);
    Route::apiResource('/customer/items',CustomerItemController::class);
    Route::apiResource('/customer/in-bound-shipments',CustomerINBoundShipmentController::class);
    Route::apiResource('/customer/out-bound-shipments',CustomerOutBoundShipmentController::class);
    Route::apiResource('/shipment/{shipment}/item',ShipmentItemsController::class,['as'=>'shipment'])
        ->except('index','show');
    Route::get('/shipment/{shipment_id}/documents',[ShipmentDocumentsController::class,'index'])->name('shipment.documents');
    Route::apiResource('/document',DocumentsController::class)->except('index');

});
