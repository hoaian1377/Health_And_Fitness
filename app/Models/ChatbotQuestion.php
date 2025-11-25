<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotQuestion extends Model
{
    use HasFactory;

    protected $table = 'chatbot_questions';

    protected $primaryKey = 'chatbotid';

    protected $fillable = [
        'question',
        'keywords',
        'answer',
        'category',
    ];
}
