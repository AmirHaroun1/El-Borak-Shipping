<?php

use App\Http\Controllers\WebControllers\PagesController;
use App\Models\customer;
use App\Models\in_bound_shipment;
use App\Models\out_bound_shipment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $attrs = customer::firstOrFail()->getAttributes();
    foreach ($attrs as $attr){
        return $attr;
    }
    return view('welcome',compact('InBoundShipments'));
});

Route::middleware('auth')->group(function(){

    // Admin routes
    Route::prefix('Admin')->middleware('CheckIfAdmin')->group(function (){
        Route::get('dashboard',[PagesController::class,'dashboard']);
    });
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
