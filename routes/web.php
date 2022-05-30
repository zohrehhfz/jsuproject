<?php

use Illuminate\Support\Facades\Route;
use App\Models\Travel;
use App\Http\Controllers\TravelController;
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
	$travels = Travel::all();
    return view('welcome',['travels'=>$travels]);
});

Route::get('/travels/show/{travel}' ,[TravelController::class,'show'])->name('ShowTravel');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
