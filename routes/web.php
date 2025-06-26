<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/users', 'users.showAll')->name('users.all');
Route::view('/game', 'game.show')->name('game.show');

Route::get('/chat', [ChatController::class, 'showChat'])->name('chat.show');
Route::post('/chat/message', [ChatController::class, 'messageReceived'])->name('chat.message');
Route::post('/chat/greet/{user}', [ChatController::class, 'greetReceived'])->name('chat.greet');