<?php



    Auth::routes();

    Route::middleware('auth')->group(function(){
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });

