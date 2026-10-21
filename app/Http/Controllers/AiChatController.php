<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AiChatHistory;
use Illuminate\Support\Facades\Http;

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
     * Mengirim pesan ke AI dan menyimpan riwayat percakapan.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userMessage = $request->input('message');

        // Deteksi ambang batas risiko / Safety Threshold (Human-in-the-Loop) sederhana
        $crisisKeywords = ['bunuh diri', 'ingin mati', 'menyerah', 'tidak ingin hidup'];
        foreach ($crisisKeywords as $keyword) {
            if (stripos($userMessage, $keyword) !== false) {
                $aiReply = "Aku sangat peduli padamu. Sepertinya kamu sedang mengalami masa yang sangat berat. Silakan hubungi layanan bantuan profesional atau psikolog mitra Emphatia segera. Kamu tidak sendirian.";
                
                AiChatHistory::create([
                    'user_id' => auth()->id(),
                    'message' => $userMessage,
                    'response' => $aiReply,
                ]);

                return response()->json([
                    'reply' => $aiReply,
                    'is_crisis' => true
                ]);
            }
        }

        // Contoh integrasi API LLM eksternal (misal: OpenAI / Gemini / API kustom)
        /*
        $response = Http::withToken(env('AI_API_KEY'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => [
                    [
                        'role' => 'system', 
                        'content' => 'Anda adalah Emphatia AI, pendamping kesehatan mental digital yang hangat, empatik, menenangkan, non-judgmental, dan menggunakan pendekatan suportif.'
                    ],
                    ['role' => 'user', 'content' => $userMessage]
                ]
            ]);
        
        $aiReply = $response->json('choices.0.message.content') ?? 'Aku mendengarkanmu. Ceritakan lebih banyak jika kamu merasa nyaman.';
        */

        // Respon simulasi jika belum menghubungkan API Key
        $aiReply = "Aku mendengarkanmu. Tarik napas perlahan... Mari kita bicarakan hal ini bersama-sama secara perlahan ya.";

        // Simpan riwayat ke database
        AiChatHistory::create([
            'user_id' => auth()->id(),
            'message' => $userMessage,
            'response' => $aiReply,
        ]);

        return response()->json([
            'reply' => $aiReply,
            'is_crisis' => false
        ]);
    }
}