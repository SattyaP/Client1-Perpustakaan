<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\RecomendationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::fallback(function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('buku', [HomeController::class, 'indexBook'])->name('buku.index');
    Route::get('/buku/{book:slug}', [HomeController::class, 'showBook'])->name('buku.show');

    Route::get('/genres', [HomeController::class, 'indexGenre'])->name('gen.index');

    Route::get('search', [HomeController::class, 'search'])->name('buku.search');

    Route::prefix('admin')->group(function () {
        Route::resource('book', BookController::class);
        Route::resource('genre', GenreController::class);
        Route::resource('recomendation', RecomendationController::class);
    });
});

