<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ScraperController;
Route::get('/', function () {
    return view('welcome');
});
Route::resource('clients', ClientController::class);
Route::get('/scrape', [ScraperController::class, 'scrape']);
Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');