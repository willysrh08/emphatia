<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SleepLog;

class SleepController extends Controller
{
    /**
     * Menampilkan daftar riwayat pemantauan tidur pengguna.
     */
    public function index()
    {
        $sleeps = SleepLog::where('user_id', auth()->id())->latest('date')->get();
        return view('sleeps.index', compact('sleeps'));
    }

    /**
     * Menyimpan data catatan tidur baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'duration_hours' => 'required|numeric|min:0|max:24',
            'sleep_quality'  => 'required|string|max:50',
            'date'           => 'required|date|before_or_equal:today',
        ]);

        SleepLog::create([
            'user_id'        => auth()->id(),
            'duration_hours' => $request->duration_hours,
            'sleep_quality'  => $request->sleep_quality,
            'date'           => $request->date,
        ]);

        return redirect()->back()->with('success', 'Catatan kualitas tidur berhasil disimpan.');
    }
}