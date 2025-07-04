<?php

use App\Http\Controllers\CitizenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
});



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/citizen-registration', [CitizenController::class, 'create'])->name('citizen.create');
    Route::post('/citizen-preview', [CitizenController::class, 'preview'])->name('citizen.preview');
    Route::get('/citizen-preview', [CitizenController::class, 'showPreview'])->name('citizen.showPreview'); // Loads preview from session
    Route::post('/citizen-submit', [CitizenController::class, 'store'])->name('citizen.store');
    Route::get('/citizen/{id}/print-id', [CitizenController::class, 'printId'])->name('citizen.printId');
    Route::get('/citizen-search', [CitizenController::class, 'showSearchForm'])->name('citizen.searchForm');
    Route::get('/citizen-search-results', [CitizenController::class, 'search'])->name('citizen.search');
    Route::delete('/citizen/{id}', [CitizenController::class, 'destroy'])->name('citizen.destroy');
    Route::get('/citizen/{id}/edit', [CitizenController::class, 'edit'])->name('citizen.edit');
    Route::patch('/citizen/{id}', [CitizenController::class, 'update'])->name('citizen.update');
    Route::get('/citizens', [CitizenController::class, 'all'])->name('citizen.all');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/citizens/export/excel', [CitizenController::class, 'exportExcel'])->name('citizens.export.excel');
    Route::get('/citizens/export/pdf', [CitizenController::class, 'exportPdf'])->name('citizens.export.pdf');
});


require __DIR__.'/auth.php';
