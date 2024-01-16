<?php

use App\Livewire\RegistrationForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

Route::view('/', 'index')->name('home');
Route::get('/register', RegistrationForm::class)->name('register');
Route::post('/webhook/register', [WebhookController::class, 'register'])->name('webhook.register');
