<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('app/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/user-management', [UserManagement::class, 'view'])->middleware(['auth', 'verified', 'role:admin'])->name('dashboard.user-management');
Route::post('/dashboard/user-management', [UserManagement::class, 'update'])->middleware(['auth', 'verified', 'role:admin'])->name('dashboard.user-management.update');
Route::delete('/dashboard/user-management/{id}', [UserManagement::class, 'destroy'])->middleware(['auth', 'verified', 'role:admin'])->name('dashboard.user-management.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
