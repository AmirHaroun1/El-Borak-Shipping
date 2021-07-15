<?php

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
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $attrs = customer::firstOrFail()->getAttributes();
    foreach ($attrs as $attr){
        return $attr;
    }
    return view('welcome',compact('InBoundShipments'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
