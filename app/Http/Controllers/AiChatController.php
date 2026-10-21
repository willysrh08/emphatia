<?php

namespace App\Http\Controllers;

use App\Models\AiChatHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiChatController extends Controller
{
    /**
     * Menampilkan halaman ruang obrolan AI.
     */
    public function index()
    {
        $histories = AiChatHistory::where('user_id', auth()->id())->oldest()->get();

        return view('chat.index', compact('histories'));
    }

    /**
     * Mengirim pesan ke AI Gemini dan menyimpan riwayat percakapan.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userMessage = $request->input('message');

        // Deteksi ambang batas risiko / Safety Threshold (Krisis / Putus Asa)
        $crisisKeywords = ['bunuh diri', 'ingin mati', 'menyerah', 'tidak ingin hidup', 'akhiri hidup', 'putus asa'];
        foreach ($crisisKeywords as $keyword) {
            if (stripos($userMessage, $keyword) !== false) {
                $aiReply = 'Aku sangat peduli padamu. Sepertinya kamu sedang mengalami masa yang sangat berat dan penuh tekanan mengenai masa depanmu. Silakan hubungi layanan bantuan profesional atau psikolog mitra Emphatia segera. Kamu tidak sendirian, dan ada orang yang peduli padamu.';

                AiChatHistory::create([
                    'user_id' => auth()->id(),
                    'message' => $userMessage,
                    'response' => $aiReply,
                ]);

                return response()->json([
                    'reply' => $aiReply,
                    'is_crisis' => true,
                ]);
            }
        }

        try {
            // Ambil Gemini API Key dari file .env
            $apiKey = env('GEMINI_API_KEY');

            // Gunakan model Gemini yang stabil
            $model = 'gemini-1.5-flash';

            // Instruksi Sistem agar AI fokus sebagai pendamping kesehatan mental yang empatik
            $systemInstructionText = 'Anda adalah Emphatia AI, asisten pendamping kesehatan mental digital yang hangat, empatik, menenangkan, non-judgmental, dan profesional. '.
                'TUGAS UTAMA: Hanya jawab pertanyaan, keluhan, atau diskusi yang berkaitan dengan psikologi, kesehatan mental, emosi, kecemasan, stres, hubungan personal, dan motivasi diri. '.
                'Jika pengguna merasa putus asa, sedih, atau bingung tentang masa depan, berikan dukungan emosional yang mendalam, validasi perasaan mereka, dan dampingi dengan penuh kelembutan. '.
                'Selalu gunakan bahasa Indonesia yang lembut dan penuh empati.';

            // Kirim request ke Gemini API menggunakan format parameter resmi (system_instruction dipisah)
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
                'system_instruction' => [
                    'parts' => [
                        ['text' => $systemInstructionText]
                    ]
                ],
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => $userMessage],
                        ],
                    ],
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $aiReply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Aku mendengarkanmu. Ceritakan lebih banyak apa yang sedang kamu rasakan saat ini ya.';
            } else {
                Log::error('Gemini API Error Response: '.$response->body());
                $aiReply = 'Maaf, saat ini aku sedang mengalami sedikit kendala koneksi. Tapi aku tetap di sini mendengarkanmu; coba ceritakan lagi perlahan ya.';
            }

        } catch (\Exception $e) {
            Log::error('Gemini Exception Error: '.$e->getMessage());
            $aiReply = 'Maaf, terjadi kesalahan sistem. Tarik napas perlahan, kita bisa coba bicarakan lagi nanti ya.';
        }

        // Simpan riwayat ke database
        AiChatHistory::create([
            'user_id' => auth()->id(),
            'message' => $userMessage,
            'response' => $aiReply,
        ]);

        return response()->json([
            'reply' => $aiReply,
            'is_crisis' => false,
        ]);
    }
}