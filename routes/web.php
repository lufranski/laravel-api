<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'home']) -> name('home');

Route::get('/movie', [MainController::class, 'movies']) -> name('home.movies');

Route::get('/movie/create', [MainController::class, 'create']) -> name('home.movies.create');

Route::post('/movie/store', [MainController::class, 'store']) -> name('home.movies.store');

Route::get('/movie/edit/{movie}', [MainController::class, 'edit']) -> name('home.movies.edit');

Route::post('/movie/update/{movie}', [MainController::class, 'update']) -> name('home.movies.update');

Route::get('/movie/delete/{movie}', [MainController::class, 'destroy']) -> name('home.movies.destroy');

use App\Http\Controllers\ApiController;

Route::get('/api/v1/movie/all', [ApiController::class, 'index']);
