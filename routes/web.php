<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ChatController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ItemController::class, 'index'])->name('dashboard');
    Route::resource('items', ItemController::class);
    Route::post('/items/{item}/mark-stored', [ItemController::class, 'markAsStored'])->name('items.mark_stored');
    Route::delete('/items/{item}/photos/{photo}', [ItemController::class, 'destroyPhoto'])->name('items.photos.destroy');

    // Chat routes
    Route::get('/items/{item}/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/items/{item}/chat', [ChatController::class, 'store'])->name('chat.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

    // Scan Token Routes
    Route::get('/scan', [AdminController::class, 'scan'])->name('scan');
    Route::post('/scan', [AdminController::class, 'processScan'])->name('scan.process');
});

require __DIR__ . '/auth.php';
