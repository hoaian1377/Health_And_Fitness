<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    public function index()
    {
        $messages = ChatMessage::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc')
            ->get();
            
        return view('chatbot', compact('messages'));
    }

    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
        ]);

        $userQuestion = $request->input('question');
        $userId = Auth::id();

        // Save User Message
        ChatMessage::create([
            'user_id' => $userId,
            'message' => $userQuestion,
            'sender' => 'user',
            'is_read' => false,
        ]);

        $userQuestionLower = strtolower($userQuestion);
        
        // 1. Exact match (highest priority)
        $exactMatch = ChatbotQuestion::where('question', 'LIKE', "%{$userQuestionLower}%")->first();
        
        $answer = null;
        $category = 'unknown';

        if ($exactMatch) {
            $answer = $exactMatch->answer;
            $category = $exactMatch->category;
        } else {
            // 2. Scoring System
            $questions = ChatbotQuestion::all();
            $bestMatch = null;
            $highestScore = 0;

            // Tokenize user question
            $userWords = $this->tokenize($userQuestionLower);

            foreach ($questions as $q) {
                $score = 0;
                $keywords = $this->tokenize($q->keywords . ' ' . $q->question);

                foreach ($userWords as $uWord) {
                    foreach ($keywords as $kWord) {
                        if ($uWord === $kWord) {
                            $score += 10;
                        } elseif (str_contains($kWord, $uWord) && strlen($uWord) > 2) {
                            $score += 5;
                        }
                    }
                }

                if ($score > $highestScore) {
                    $highestScore = $score;
                    $bestMatch = $q;
                }
            }

            if ($bestMatch && $highestScore >= 10) {
                $answer = $bestMatch->answer;
                $category = $bestMatch->category;
            } else {
                $answer = 'Xin lỗi, tôi chưa hiểu câu hỏi của bạn. Câu hỏi của bạn đã được gửi đến admin, vui lòng chờ phản hồi.';
            }
        }

        // Save Bot Message
        if ($answer) {
            ChatMessage::create([
                'user_id' => $userId,
                'message' => $answer,
                'sender' => 'bot',
                'is_read' => true,
            ]);
        }

        return response()->json([
            'answer' => $answer,
            'category' => $category
        ]);
    }

    public function fetchMessages()
    {
        $messages = ChatMessage::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc')
            ->get();
            
        return response()->json($messages);
    }

    private function tokenize($text)
    {

        $text = strtolower($text);
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', '', $text); 
        $words = explode(' ', $text);
        return array_filter($words, function($w) {
            return strlen($w) > 1; 
        });
    }
}
