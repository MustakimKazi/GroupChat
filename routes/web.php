
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;

// Laravel welcome page
Route::get('/', function () {
    return view('login');
});

// User Resource Route (creates all 7 routes)
Route::resource('users', UserController::class);

Route::get('/users_create', [UserController::class, 'create'])->name('users_create');

Route::post('/users_srtore', [UserController::class, 'store'])->name('users_srtore');


Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::get('/index', [UserController::class, 'index'])->name('index.page');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');





Route::middleware('auth')->group(function () {
    Route::get('/chat', [UserController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [UserController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chat/clear', [UserController::class, 'clearChat'])->name('chat.clear'); // ✅ new
});
