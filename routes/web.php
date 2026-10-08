<?php

use App\Http\Controllers\PklPortalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PklPortalController::class, 'index'])->name('pkl.index');
Route::get('/api/mitra/{id}', [PklPortalController::class, 'apiPartnerDetail'])->name('pkl.partner.api');
Route::post('/daftar-pkl', [PklPortalController::class, 'store'])->name('pkl.daftar');
Route::get('/tracking-pkl', [PklPortalController::class, 'tracking'])->name('pkl.tracking');
Route::get('/api/webhook-simulation/{ticket}', [PklPortalController::class, 'webhookSimulation'])->name('pkl.webhook');
