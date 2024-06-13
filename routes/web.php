<?php

use App\Http\Controllers\errorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testController;
use App\Http\Controllers\weatherController;
use App\Http\Controllers\blogController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\loginController;
use \App\Http\Middleware\IsAdminMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('LoginPage');
});
Route::any('/test/{currency?}', [testController::class, 'testAction']);

Route::get('/currency/list',[CurrencyController::class, 'list'])->name('currencyList');
Route::get('/currency/listJS',[CurrencyController::class, 'listJS'])->name('ListJS');
Route::middleware([IsAdminMiddleware::class])->group(function (){
    Route::get('/currency/get/{code}',[CurrencyController::class, 'get'])->name('currencyGet');
    Route::post('/currency/save/{currency?}',[CurrencyController::class, 'save'])->name('currencySave');
    Route::any('/currency/edit/{currency}',[CurrencyController::class, 'FormEdit'])->name('currencyEdit');
    Route::get('/currency/saveForm',[CurrencyController::class, 'saveForm'])->name('currencySaveForm');
});


Route::get('/weather/{city?}/{time?}', [weatherController::class, 'getWeather']);
Route::any('/article/{article?}',    [blogController::class, 'web']);
Route::post('/hello', [loginController ::class, 'getAccessRights'])->name('helloForm');
Route::any('/{time?}', [errorController ::class, 'getError'])->name('errorForm');

