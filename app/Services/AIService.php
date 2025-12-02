<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.openai.com/v1';

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
    }

    /**
     * Generate a draft reply for a ticket using OpenAI.
     *
     * @param Ticket $ticket
     * @return string|null
     */
    public function generateDraftReply(Ticket $ticket)
    {
        if (!$this->apiKey) {
            Log::warning('OpenAI API key is missing.');
            return null;
        }

        $messages = $this->buildConversationHistory($ticket);

        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(30)
                ->post("{$this->baseUrl}/chat/completions", [
                    'model' => 'gpt-4o-mini', // Or gpt-3.5-turbo for lower cost
                    'messages' => $messages,
                    'temperature' => 0.7,
                    'max_tokens' => 500,
                ]);

            if ($response->successful()) {
                $content = $response->json('choices.0.message.content');
                return trim($content);
            } else {
                Log::error('OpenAI API Error: ' . $response->body());
                return null;
            }
        } catch (\Exception $e) {
            Log::error('OpenAI Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Build the conversation history for the AI context.
     *
     * @param Ticket $ticket
     * @return array
     */
    protected function buildConversationHistory(Ticket $ticket)
    {
        $systemPrompt = "You are a professional, empathetic, and helpful customer support agent for 'PortalPro'. 
        Your goal is to assist the client with their issue based on the ticket description and history.
        - Be concise but thorough.
        - Use a polite tone.
        - If you need more information, ask for it clearly.
        - If the issue seems technical, suggest standard troubleshooting steps.
        - Do not invent facts about the user's account unless provided in the context.";

        $messages = [
            ['role' => 'system', 'content' => $systemPrompt],
            ['role' => 'user', 'content' => "Ticket Subject: {$ticket->category}\nDescription: {$ticket->description}\nImpact: {$ticket->impact}"]
        ];

        // Add recent messages (limit to last 10 to save tokens)
        foreach ($ticket->messages()->latest()->take(10)->get()->reverse() as $message) {
            $role = $message->user_id === $ticket->user_id ? 'user' : 'assistant';
            // If the message is internal, we might want to include it as context for the AI but mark it differently, 
            // or exclude it if it contains sensitive info. For now, let's include it as 'system' context if it's internal.
            
            if ($message->is_internal) {
                $messages[] = ['role' => 'system', 'content' => "Internal Note: " . $message->message];
            } else {
                $messages[] = ['role' => $role, 'content' => $message->message];
            }
        }

        return $messages;
    }
}
