<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmlogController;
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

require __DIR__.'/auth.php';

// FILMLOG ROUTES
Route::get('/', [FilmController::class, 'read']);
Route::get('/dashboard', [FilmController::class, 'read'])->middleware(['auth'])->name('dashboard');
Route::POST('/search-film', [FilmController::class, 'search']);
Route::POST('/add-film', [FilmController::class, 'create']);
Route::post('/delete-filmlog/{filmlog}', [FilmlogController::class, 'delete']);
