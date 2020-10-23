<?php

use Illuminate\Support\Facades\Route;

Route::prefix('flights')->group(function () {
    Route::get('', 'VoosController@voos')->name('voos');
});

