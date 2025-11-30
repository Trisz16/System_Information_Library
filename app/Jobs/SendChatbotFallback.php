<?php

namespace App\Jobs;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendChatbotFallback implements ShouldQueue
{
    use Queueable;

    protected $chat;
    protected $originalMessage;

    /**
     * Create a new job instance.
     */
    public function __construct(Chat $chat, Message $originalMessage)
    {
        $this->chat = $chat;
        $this->originalMessage = $originalMessage;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Check if any admin has replied since the message was sent
        $adminReplies = Message::where('chat_id', $this->chat->id)
            ->where('created_at', '>', $this->originalMessage->created_at)
            ->whereIn('sender_type', ['admin', 'staff'])
            ->exists();

        // Also check if chatbot has already responded
        $chatbotReplies = Message::where('chat_id', $this->chat->id)
            ->where('created_at', '>', $this->originalMessage->created_at)
            ->where('sender_type', 'chatbot')
            ->where('metadata->type', 'fallback')
            ->exists();

        if (!$adminReplies && !$chatbotReplies) {
            // No admin reply and no chatbot fallback yet, send chatbot fallback
            $this->sendChatbotFallback();
        }
    }

    /**
     * Send chatbot fallback message
     */
    private function sendChatbotFallback()
    {
        $fallbackMessage = "Terima kasih atas pesan Anda. Admin perpustakaan sedang tidak online saat ini. Kami akan membalas pesan Anda segera setelah jam operasional dimulai (Senin-Jumat pukul 08:00-17:00 WIB). Jika Anda memiliki pertanyaan mendesak, silakan hubungi kami melalui telepon (021) 1234567.";

        Message::create([
            'chat_id' => $this->chat->id,
            'sender_id' => 1, // System user ID
            'message' => $fallbackMessage,
            'sender_type' => 'chatbot',
            'metadata' => [
                'type' => 'fallback',
                'original_message_id' => $this->originalMessage->id,
                'reason' => 'no_admin_reply_10_seconds'
            ],
        ]);

        // Update chat timestamp
        $this->chat->update(['last_message_at' => now()]);
    }
}
