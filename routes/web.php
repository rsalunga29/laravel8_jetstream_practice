<?php

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

// Route::middleware(['auth:sanctum', 'verified'])->get('/test', function () {
//     return Inertia\Inertia::render('Test');
// })->name('test');

Route::prefix('market')->middleware(['auth:sanctum', 'verified'])->group(function () {
    
    Route::get('/', 'MarketController@index')->name('market.index');

    Route::prefix('product')->group(function () {

        Route::post('/create', 'MarketController@createProduct')->name('market-product.create');

        Route::patch('/update/{id}', 'MarketController@updateProduct')->name('market-product.update');

        Route::delete('/delete/{id}', 'MarketController@deleteProduct')->name('market-product.delete');

    });

});
