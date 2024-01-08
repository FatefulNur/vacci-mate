<?php

use App\Livewire\RegistrationForm;
use Illuminate\Support\Facades\Route;

Route::get('/register', RegistrationForm::class)->name('register');
