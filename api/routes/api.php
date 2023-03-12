<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::controller(PokemonController::class)
->prefix('pokemons')
->name('pokemons.')
->group(function () {
    Route::get('/',        'index')->name('index');
    Route::post('/import', 'import')->name('import');
});