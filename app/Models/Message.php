<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'chat_id',
        'sender_id',
        'message',
        'sender_type',
        'is_read',
        'metadata',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'metadata' => 'array',
    ];

    /**
     * Get the chat that owns the message
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * Get the sender of the message
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Check if message is from user
     */
    public function isFromUser()
    {
        return $this->sender_type === 'user';
    }

    /**
     * Check if message is from admin
     */
    public function isFromAdmin()
    {
        return $this->sender_type === 'admin';
    }

    /**
     * Check if message is from staff
     */
    public function isFromStaff()
    {
        return $this->sender_type === 'staff';
    }

    /**
     * Check if message is from chatbot
     */
    public function isFromChatbot()
    {
        return $this->sender_type === 'chatbot';
    }

    /**
     * Mark message as read
     */
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }
}
