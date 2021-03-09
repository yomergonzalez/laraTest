<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect('publication');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('publication', PublicationController::class, [
    'names' => [
        'store' => 'new',
    ],
])->middleware('auth');

Route::post('/comment/{publication}', [App\Http\Controllers\CommentController::class, 'store'])
        ->name('comment.store')->middleware('auth');


Route::get('/comment', [App\Http\Controllers\CommentController::class, 'index'])
        ->name('hola')->middleware('auth');

