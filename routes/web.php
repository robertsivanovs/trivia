<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

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

// Initial index view
Route::view('/', 'index');

// Game start view
Route::get('/start', [GameController::class, 'startGame'])->name('trivia.start');

// Handle question fetching
Route::get('/question', [GameController::class, 'fetchQuestion'])->name('trivia.question');
