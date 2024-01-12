<?php

use App\Livewire\RegistrationForm;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');
Route::get('/register', RegistrationForm::class)->name('register');
