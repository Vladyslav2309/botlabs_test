<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\ManagerController;


Route::post('/leads', [LeadController::class, 'store']);
Route::post('/leads/{lead}/calls', [CallController::class, 'store']);
Route::get('/managers/{manager}/leads', [ManagerController::class, 'leads']);
