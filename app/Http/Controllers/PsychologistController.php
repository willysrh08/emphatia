<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PsychologistController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Data real-time untuk psikolog & sesi (bisa disesuaikan dengan database Anda)
        $nextSession = (object) [
            'psychologist_name' => 'Gladys Fredelina, M.Psi',
            'psychologist_photo' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCU2xR7qNZHoYRBDNG6ZeNlazicuPsy1fYjCufhalA4913xDepwAEdX3V3AaoklAEf64QHgDSrzFdpqSGierjhGPIfGiMDUGOX3E-41iY4IzxK-5lOz2Evla2-BVk2cUmioPW04ar27f2SQZJ22CJESc3Xd0KMtfwfq4LnjWdp3KSXXpDPJP1r3fOFN3tuLnE5RQial2pFjlp6VDbYj5ocLyF9Jf8ELFnizooPmBdA1oNJIp2p5rXMBMw',
            'session_type' => 'Clinical Psychologist',
            'schedule' => 'Today, 16:00 WIB',
            'join_url' => '#'
        ];

        $userStreak = 5; // Bisa diambil dari database tabel users/streaks
        $hasUnreadNotifications = true;

        // Jika request AJAX (untuk update real-time)
        if ($request->ajax()) {
            return response()->json([
                'nextSession' => $nextSession,
                'userStreak' => $userStreak
            ]);
        }

        // Diubah langsung mengarah ke view 'psychologists' (resources/views/psychologists.blade.php)
        return view('psychologists', compact('nextSession', 'userStreak', 'hasUnreadNotifications'));
    }
}