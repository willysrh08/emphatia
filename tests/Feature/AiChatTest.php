<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AiChatTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_chat_pages(): void
    {
        $this->get(route('chat.index'))->assertRedirect(route('login'));

        $this->post(route('chat.send'), [
            'message' => 'Halo',
        ])->assertRedirect(route('login'));

        $this->assertDatabaseCount('ai_chat_histories', 0);
    }

    public function test_crisis_message_returns_crisis_response_saves_history_and_does_not_call_gemini(): void
    {
        Http::fake();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('chat.send'), [
            'message' => 'Saya merasa ingin mati dan bingung.',
        ]);

        $response->assertOk()
            ->assertJson([
                'is_crisis' => true,
                'reply' => 'Aku sangat peduli padamu. Sepertinya kamu sedang mengalami masa yang sangat berat dan penuh tekanan mengenai masa depanmu. Silakan hubungi layanan bantuan profesional atau psikolog mitra Emphatia segera. Kamu tidak sendirian, dan ada orang yang peduli padamu.',
            ]);

        $this->assertDatabaseHas('ai_chat_histories', [
            'user_id' => $user->id,
            'message' => 'Saya merasa ingin mati dan bingung.',
            'response' => 'Aku sangat peduli padamu. Sepertinya kamu sedang mengalami masa yang sangat berat dan penuh tekanan mengenai masa depanmu. Silakan hubungi layanan bantuan profesional atau psikolog mitra Emphatia segera. Kamu tidak sendirian, dan ada orang yang peduli padamu.',
        ]);

        Http::assertNothingSent();
    }

    public function test_successful_message_calls_gemini_returns_reply_and_saves_history(): void
    {
        config([
            'services.gemini.key' => 'test-api-key',
            'services.gemini.model' => 'gemini-3.5-flash-lite',
            'services.gemini.base_url' => 'https://generativelanguage.googleapis.com/v1beta',
        ]);

        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => 'Aku mendengar kamu. Ceritakan lebih lanjut ya.'],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('chat.send'), [
            'message' => 'Aku merasa cemas hari ini.',
        ]);

        $response->assertOk()
            ->assertJson([
                'is_crisis' => false,
                'reply' => 'Aku mendengar kamu. Ceritakan lebih lanjut ya.',
            ]);

        $this->assertDatabaseHas('ai_chat_histories', [
            'user_id' => $user->id,
            'message' => 'Aku merasa cemas hari ini.',
            'response' => 'Aku mendengar kamu. Ceritakan lebih lanjut ya.',
        ]);

        Http::assertSent(function ($request) {
            return str_contains($request->url(), '/models/gemini-3.5-flash-lite:generateContent')
                && str_contains($request->url(), 'key=test-api-key')
                && $request['contents'][0]['parts'][0]['text'] === 'Aku merasa cemas hari ini.';
        });
    }

    public function test_missing_api_key_returns_safe_fallback_and_saves_history(): void
    {
        Http::fake();
        config(['services.gemini.key' => null]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('chat.send'), [
            'message' => 'Halo, apa kabar?',
        ]);

        $response->assertOk()
            ->assertJson([
                'is_crisis' => false,
                'reply' => 'Maaf, saat ini aku sedang mengalami sedikit kendala koneksi. Tapi aku tetap di sini mendengarkanmu; coba ceritakan lagi perlahan ya.',
            ]);

        $this->assertDatabaseHas('ai_chat_histories', [
            'user_id' => $user->id,
            'message' => 'Halo, apa kabar?',
            'response' => 'Maaf, saat ini aku sedang mengalami sedikit kendala koneksi. Tapi aku tetap di sini mendengarkanmu; coba ceritakan lagi perlahan ya.',
        ]);

        Http::assertNothingSent();
    }

    public function test_gemini_api_failure_returns_safe_fallback_and_saves_history(): void
    {
        config([
            'services.gemini.key' => 'test-api-key',
            'services.gemini.model' => 'gemini-3.5-flash-lite',
            'services.gemini.base_url' => 'https://generativelanguage.googleapis.com/v1beta',
        ]);

        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response(['error' => 'quota exceeded'], 500),
        ]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('chat.send'), [
            'message' => 'Aku sedang sedih.',
        ]);

        $response->assertOk()
            ->assertJson([
                'is_crisis' => false,
                'reply' => 'Maaf, saat ini aku sedang mengalami sedikit kendala koneksi. Tapi aku tetap di sini mendengarkanmu; coba ceritakan lagi perlahan ya.',
            ]);

        $this->assertDatabaseHas('ai_chat_histories', [
            'user_id' => $user->id,
            'message' => 'Aku sedang sedih.',
            'response' => 'Maaf, saat ini aku sedang mengalami sedikit kendala koneksi. Tapi aku tetap di sini mendengarkanmu; coba ceritakan lagi perlahan ya.',
        ]);
    }
}
