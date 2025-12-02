<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketMessageController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $packs = \App\Models\Pack::all();
    return view('welcome', compact('packs'));
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tickets', TicketController::class);
    Route::post('/tickets/{ticket}/messages', [TicketMessageController::class, 'store'])->name('tickets.messages.store');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/tickets', [AdminController::class, 'tickets'])->name('tickets.index');
        Route::get('/tickets/{ticket}', [AdminController::class, 'showTicket'])->name('tickets.show');
        Route::patch('/tickets/{ticket}/status', [AdminController::class, 'updateTicketStatus'])->name('tickets.updateStatus');
        Route::post('/tickets/{ticket}/messages', [AdminController::class, 'storeTicketMessage'])->name('tickets.messages.store');
        Route::get('/clients', [AdminController::class, 'clients'])->name('clients.index');
        Route::get('/clients/{client}', [AdminController::class, 'showClient'])->name('clients.show');
        Route::patch('/clients/{client}/pack', [AdminController::class, 'updateClientPack'])->name('clients.updatePack');
        Route::post('/tickets/{ticket}/ai-reply', [AdminController::class, 'generateAiReply'])->name('tickets.aiReply');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
