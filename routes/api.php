<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\UserAuthController;

Route::post('auth/login', [UserAuthController::class, 'login']);
Route::post('auth/logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('notes', [NoteController::class, 'index'])->middleware('auth:sanctum');
Route::get('show-note/{note}', [NoteController::class, 'show'])->middleware('auth:sanctum');
