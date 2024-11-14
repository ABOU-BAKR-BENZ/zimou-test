<?php

use App\Exports\PackagesExport;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('/packages', PackageController::class)->middleware(['auth', 'verified']);
Route::post('/packages/action', [PackageController::class, 'performAction'])->middleware(['auth', 'verified'])->name('packages.action');

Route::get('/test-export', function () {
    return Excel::download(new PackagesExport([11, 12, 13]), 'test_packages.xlsx');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
