<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    protected $fillable = [
        'type',
        'student_id',
        'admin_staff_id',
        'status',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    /**
     * Get the student that owns the chat
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the admin/staff that owns the chat
     */
    public function adminStaff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_staff_id');
    }

    /**
     * Get the messages for the chat
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'asc');
    }

    /**
     * Get unread messages count for a specific user
     */
    public function getUnreadCountForUser($userId)
    {
        return $this->messages()
            ->where('sender_id', '!=', $userId)
            ->where('is_read', false)
            ->count();
    }

    /**
     * Mark messages as read for a specific user
     */
    public function markAsReadForUser($userId)
    {
        return $this->messages()
            ->where('sender_id', '!=', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    /**
     * Check if chat is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Check if chat is with admin/staff
     */
    public function isAdminChat()
    {
        return $this->type === 'admin_chat';
    }

    /**
     * Check if chat is AI assistant
     */
    public function isAiAssistant()
    {
        return $this->type === 'ai_assistant';
    }
}
