<?php

namespace App\Http\Controllers;
use App\Services\GroqService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    protected $groq;

    public function __construct(GroqService $groq)
    {
        $this->groq = $groq;
    }

    public function showForm()
    {
        return view('ai.chat');
    }

    public function generateText(Request $request)
    {
        $prompt = $request->input('prompt');

        // Get existing chat history or empty array
        $chatHistory = session('chatHistory', []);

        // Add user's message
        $chatHistory[] = ['role' => 'user', 'content' => $prompt];

        // Prepare messages to send to API, including history if needed
        // (You can pass full history or just the last user prompt and system prompt)
        $messages = [
            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
        ];

        // Include previous user + assistant messages for context
        foreach ($chatHistory as $msg) {
            $messages[] = $msg;
        }

        // Call Groq API
        $generatedText = $this->groq->chat($messages);

        // Add assistant's response to history
        $chatHistory[] = ['role' => 'assistant', 'content' => $generatedText];

        // Save updated chat history to session
        session(['chatHistory' => $chatHistory]);

        return view('ai.chat'); // chatHistory will be retrieved from session in Blade
    }

    public function clearChat()
    {
        session()->forget('chatHistory');
        return redirect()->route('ai.chat');
    }

}
