<?php

use App\Exports\PackagesExport;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Models\Package;
use App\Models\Store;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {

    return view('dashboard', [
        'user_name' => Auth::user()->name,
        'packages_number' => Package::count(),
        'pending_packages' => Package::where('status_id', 1)->count(),
        'delivered_packages' => Package::where('status_id', 5)->count(),
        'in_transit_packages' => Package::where('status_id', 2)->count(),
        'returned_packages' => Package::where('status_id', 6)->count(),
        'stores' => Store::count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('/packages', PackageController::class)->middleware(['auth', 'verified']);
Route::post('/packages/action', [PackageController::class, 'performAction'])->middleware(['auth', 'verified'])->name('packages.action');
Route::get('/package-tracking', [PackageController::class, 'trackingPage'])->middleware(['auth', 'verified'])->name('package.tracking');
Route::get('/track-packages', [PackageController::class, 'track'])->name('packages.track');

Route::resource('/stores', StoreController::class)->middleware(['auth', 'verified'])->except('destroy');
Route::delete('/stores', [StoreController::class, 'destroy'])->name('stores.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
