<?php

use App\Models\customer;
use App\Models\in_bound_shipment;
use App\Models\User;
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
    //$users = customer::WithUserInfo()->with('items')->paginate(10);

    return $in = in_bound_shipment::WithShipmentInfo()->paginate(20);
    return view('welcome',compact('in'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
