<?php

use App\Http\Controllers\BotChatController;
use Illuminate\Support\Facades\Route;

Route::post('/bot/chat', [BotChatController::class, 'chat']);
Route::get('/bot/config/{chatbot}', [BotChatController::class, 'getConfig']);
