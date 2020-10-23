<?php

use Illuminate\Support\Facades\Route;

Route::prefix('flights')->group(function () {
    Route::get('', 'VoosController@voos')->name('voos');
    Route::get('outbound', 'VoosController@voosOutbound')->name('voos.outbound');
    Route::get('iutbound', 'VoosController@voosInbound')->name('voos.inbound');
});

