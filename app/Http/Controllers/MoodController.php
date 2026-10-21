<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoodLog;

class MoodController extends Controller
{
    /**
     * Menampilkan halaman daftar dan grafik mood pengguna.
     */
    public function index()
    {
        // Ambil data mood milik user yang sedang login, diurutkan dari yang terbaru
        $moods = MoodLog::where('user_id', auth()->id())->latest()->get();
        
        return view('moods.index', compact('moods'));
    }

    /**
     * Menyimpan data catatan mood baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mood_score' => 'required|integer|min:1|max:5',
            'mood_label' => 'nullable|string|max:50',
            'notes'      => 'nullable|string|max:500',
        ]);

        MoodLog::create([
            'user_id'    => auth()->id(),
            'mood_score' => $request->mood_score,
            'mood_label' => $request->mood_label,
            'notes'      => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Catatan suasana hati berhasil disimpan.');
    }
}