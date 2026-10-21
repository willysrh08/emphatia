<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\SleepController;
use App\Http\Controllers\AiChatController;
use App\Http\Controllers\PsychologistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini tempat Anda mendaftarkan rute web untuk aplikasi Emphatia.
|
*/

// Halaman Utama & Dashboard
Route::get('/', function () {
    return view('dashboard');
})->name('home');

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