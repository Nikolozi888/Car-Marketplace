<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    // public function index()
    // {
    //     return view('chat');
    // }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'history' => 'array',
        ]);

        $userMessage = $request->input('message');
        $history = $request->input('history', []);
        $apiKey = env('GEMINI_API_KEY');

        // Gemini-ს სჭირდება სპეციფიკური ფორმატი ისტორიისთვის
        $formattedHistory = [];

        foreach ($history as $msg) {
            // Google იყენებს 'user' და 'model' როლებს ('assistant'-ის ნაცვლად)
            $role = ($msg['role'] === 'user') ? 'user' : 'model';
            
            $formattedHistory[] = [
                'role' => $role,
                'parts' => [
                    ['text' => $msg['content']]
                ]
            ];
        }

        // ვამატებთ მიმდინარე მესიჯს
        $formattedHistory[] = [
            'role' => 'user',
            'parts' => [
                ['text' => $userMessage]
            ]
        ];

        try {
            // *** განახლებული მოდელი და URL ***
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                'contents' => $formattedHistory
            ]);

            if ($response->failed()) {
                // შეცდომის ლოგირება
                Log::error('Gemini API Error: ' . $response->body());
                return response()->json(['error' => 'API Error'], 500);
            }

            // პასუხის ამოღება Google-ის სტრუქტურიდან
            $data = $response->json();
            
            // ვამოწმებთ, რომ პასუხი ნამდვილად არსებობს
            $aiReply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'ვერ გავიგე, თავიდან სცადეთ.';

            return response()->json([
                'reply' => $aiReply
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Server Error'], 500);
        }
    }
}