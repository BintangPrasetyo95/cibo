<?php

use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'pesan' => 'Fondasi project polosan sukses berjalan!'
    ]);
});

Route::resource('film', FilmController::class);
