<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotQuestion;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
        ]);

        $userQuestion = strtolower($request->input('question'));
        
        // 1. Exact match (highest priority)
        $exactMatch = ChatbotQuestion::where('question', 'LIKE', "%{$userQuestion}%")->first();
        if ($exactMatch) {
            return response()->json([
                'answer' => $exactMatch->answer,
                'category' => $exactMatch->category
            ]);
        }

        // 2. Scoring System
        $questions = ChatbotQuestion::all();
        $bestMatch = null;
        $highestScore = 0;

        // Tokenize user question (remove punctuation, convert to lowercase)
        $userWords = $this->tokenize($userQuestion);

        foreach ($questions as $q) {
            $score = 0;
            
            // Tokenize stored keywords and question
            $keywords = $this->tokenize($q->keywords . ' ' . $q->question);

            foreach ($userWords as $uWord) {
                foreach ($keywords as $kWord) {
                    if ($uWord === $kWord) {
                        $score += 10; // Exact word match
                    } elseif (str_contains($kWord, $uWord) && strlen($uWord) > 2) {
                        $score += 5; // Partial match
                    }
                }
            }

            if ($score > $highestScore) {
                $highestScore = $score;
                $bestMatch = $q;
            }
        }

        // Threshold for acceptance (adjust as needed)
        if ($bestMatch && $highestScore >= 10) {
            return response()->json([
                'answer' => $bestMatch->answer,
                'category' => $bestMatch->category
            ]);
        }

        return response()->json([
            'answer' => 'Xin lỗi, tôi chưa hiểu câu hỏi của bạn. Bạn có thể hỏi rõ hơn hoặc dùng từ khóa khác được không?',
            'category' => 'unknown'
        ]);
    }

    private function tokenize($text)
    {
        // Convert to lowercase, remove punctuation, split by spaces
        $text = strtolower($text);
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', '', $text); // Keep letters, numbers, spaces
        $words = explode(' ', $text);
        return array_filter($words, function($w) {
            return strlen($w) > 1; // Filter out single characters
        });
    }
}
