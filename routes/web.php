<?php

use App\Http\Controllers\AiChatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\PsychologistController;
use App\Http\Controllers\SleepController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini tempat Anda mendaftarkan rute web untuk aplikasi Emphatia.
|
*/

// Halaman Publik (Opsional jika ingin bisa diakses tanpa login)
Route::get('/', function () {
    return view('dashboard');
})->name('home');

// Rute Autentikasi (Guest - hanya untuk yang belum login)
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

// Logout (wajib login)
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Rute yang Memerlukan Autentikasi (Wajib Login)
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Modul Mood Tracking (Pencatatan Suasana Hati)
    Route::get('/moods', [MoodController::class, 'index'])->name('moods.index');
    Route::post('/moods', [MoodController::class, 'store'])->name('moods.store');

    // Modul Sleep Tracking (Pemantauan Tidur)
    Route::get('/sleeps', [SleepController::class, 'index'])->name('sleeps.index');
    Route::post('/sleeps', [SleepController::class, 'store'])->name('sleeps.store');

    // Modul Emphatia AI Chatbot (AI Companion)
    Route::get('/chat', [AiChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [AiChatController::class, 'sendMessage'])->name('chat.send');

    // Modul My Psychologist (Konsultasi & Care Plan)
    Route::get('/psychologists', [PsychologistController::class, 'index'])->name('psychologists.index');

});
