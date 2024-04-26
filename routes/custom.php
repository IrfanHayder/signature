<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('contact-us', [FrontendController::class, 'contact_us'])->name('page.contact_us');
