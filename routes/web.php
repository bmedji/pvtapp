<?php

use App\Http\Controllers\DevisController;
use App\Http\Controllers\SouscriptionController;
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

Route::get('/', [DevisController::class, "index"])->name("devis");


Route::post("/generatedevis",[DevisController::class,"generateDevis"])->name("generatedevis");

Route::get('/souscription', [SouscriptionController::class, "index"])->name("souscription");

Route::post("/searchdevis",[SouscriptionController::class, "searchDevis"])->name("searchdevis");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
